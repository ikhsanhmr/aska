<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Admin\MasterData\Region;
use App\Models\Admin\MasterData\Unit;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private $user, $region, $unit;
    public function __construct(
        User $user,
        Region $region,
        Unit $unit
    ) {
        $this->user = $user;
        $this->region = $region;
        $this->unit = $unit;
    }

    public function index()
    {
        return view('admin.master_data.user.index', ['data' => $this->user->getAllData()]);
    }

    public function create()
    {
        return view('admin.master_data.user.create', [
            'regions' => $this->region->getAllData(),
        ]);
    }

    public function store(StoreUserRequest $request)
    {
        try {
            $data = $request->validated();
            $path = NULL;
            if ($request->hasFile('photo')) {
                $upload_path = 'public/users';
                $filename = time() . '_' . $request->file('photo')->getClientOriginalName();
                $path = $request->file('photo')->storeAs(
                    $upload_path,
                    $filename
                );
            }
            $data['photo'] = $path;
            User::create($data);
        } catch (\Exception $e) {
            return redirect(route('users.index'))->with('error', 'Gagal Tambah Data ' . $e->getMessage());
        }
        return redirect(route('users.index'))->with('success', 'Berhasil Tambah Data');
    }

    public function edit(User $user)
    {
        $regions = $this->region->getAllData();
        return view('admin.master_data.user.edit', compact(['user', 'regions']));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        try {
            $data = $request->validated();
            if ($request->password != null) {
                $data['password'] = $request->password;
            }

            if ($request->hasFile('photo')) {
                $upload_path = 'public/users';
                $filename = time() . '_' . $request->file('photo')->getClientOriginalName();
                !is_null($user->photo) && Storage::delete($user->photo);
                $path = $request->file('photo')->storeAs(
                    $upload_path,
                    $filename
                );
                $data['photo'] = $path;
            }
            $user->update($data);
        } catch (\Exception $e) {
            return redirect(route('users.index'))->with('error', 'Gagal Edit Data ' . $e->getMessage());
        }
        return redirect(route('users.index'))->with('success', 'Berhasil Edit Data');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect(route('users.index'))->with('success', 'Berhasil Hapus Data');
    }

    public function show(User $user)
    {
        return view('admin.master_data.user.show', compact('user'));
    }

    public function editProfile()
    {
        $user = Auth::user();
        $regions = $this->region->getAllData();
        $units = $this->unit->getAllData();
        return view('admin.master_data.user.edit', compact(['user', 'regions', 'units']));
    }

    public function sync()
    {
        try {
            // Increase PHP script execution time to avoid timeouts
            set_time_limit(1000);

            // Fetch all active employees
            $employees = DB::connection('hris')->table('data_pegawai')->where('aktif', 1)->get();
            // Check if employees is a collection or array
            if (!is_iterable($employees)) {
                throw new \Exception('Failed to retrieve employee data.');
            }

            // Loop through each employee and sync data
            foreach ($employees as $employee) {
                $nama = $employee->nama;
                $nip = $employee->nip;
                $jabatan = $employee->jabatan;
                $email = $employee->email; // Construct email from NIP
                $username = $nip; // Assuming username is based on NIP
                $password = $nip . '@plnnd'; // Default password

                // Update or create user based on NIP
                $userExist = User::where('nip', $nip)->first();
                $kd_region = $this->getKdRegion($employee->region);
                if ($userExist) {
                    $userEmail = $userExist->email;
                    if ($userExist->email == null && $email != null) {
                        $userEmailExist = User::where('email', $email)->get();
                        $userEmail = count($userEmailExist) >= 1 ? $nip . "@gmail.com" : $email;
                    }
                    $userExist->update([
                        'name' => $nama,
                        'username' => $username,
                        'kd_region' => $kd_region,
                        'email' => $userEmail,
                        'position' => $jabatan,
                        'password' => $password,
                    ]);
                } else {
                    $userEmailExist = User::where('email', $email)->get();
                    $email = count($userEmailExist) >= 1 ? $nip . "@gmail.com" : $email;
                    $user = User::create(
                        [
                            'kd_region' => $kd_region,
                            'name' => $nama,
                            'username' => $username,
                            'nip' => $nip,
                            'email' => $email,
                            'password' => $password,
                            'position' => $jabatan,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]
                    );
                }
            }

            // Return view with all user data
            return response()->json(['message' => 'Berhasil Sync'], 200);
        } catch (\Exception $e) {
            // Log the error message
            Log::error('Sync Error: ' . $e->getMessage());

            // Optionally, return an error response or view
            return response()->json(['message' => 'Data synchronization failed: ' . $e->getMessage()], 500);
        }
    }

    function getKdRegion($region)
    {
        if ($region == '' || $region == null || $region == '-' || $region == 'KANTOR PUSAT' || $region == 'KANTOR PUSAT - PLNT') {
            return '09';
        } elseif ($region == 'KALIMANTAN 1' || $region == 'UNIT PELAKSANA KALIMANTAN 1' || $region == 'UNIT  PELAKSANA KALIMANTAN 1' || $region == 'REGION KALIMANTAN 1' || $region == 'REGION KALBAR') {
            return '03';
        } elseif ($region == 'KALIMANTAN 2' || $region == 'UNIT PELAKSANA KALIMANTAN 2' || $region == 'UNIT  PELAKSANA KALIMANTAN 2' || $region == 'REGION KALSELTENG') {
            return '04';
        } elseif ($region == 'KALIMANTAN 3' || $region == 'UNIT PELAKSANA KALIMANTAN 3' || $region == 'UNIT  PELAKSANA KALIMANTAN 3' || $region == 'REGION KALIMANTAN 3' || $region == 'REGION KALTIMRA') {
            return '05';
        } elseif ($region == 'SULAWESI 1' || $region == 'UNIT PELAKSANA SULAWESI 1' || $region == 'UNIT SULAWESI 1' || $region == 'REGION SULAWESI 1') {
            return '02';
        } elseif ($region == 'SULAWESI 2' || $region == 'UNIT PELAKSANA SULAWESI 2') {
            return '01';
        } elseif ($region == 'NUSA TENGGARA' || $region == ' NUSA TENGGARA') {
            return '07';
        } elseif ($region == 'MALUKU') {
            return '10';
        } elseif ($region == 'PAPUA' || $region == 'MALUKU PAPUA' || $region == 'AREA PAPUA' || $region == 'MALUKU DAN PAPUA' || $region == ' MALUKU DAN PAPUA' || $region == ' MALUKU DAN  PAPUA' || $region == 'MALUKU DAN  PAPUA' || $region == 'REGION MALUKU PAPUA') {
            return '08';
        }
        return '09';
    }
}
