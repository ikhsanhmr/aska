<?php

namespace App\Http\Controllers\Admin\MasterData;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Admin\MasterData\Employee;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

class EmployeeController extends Controller
{
    private $employee;
    public function __construct(
        Employee $employee
    ) {
        $this->employee = $employee;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view(
            'admin.master_data.employee.index',
            [
                'data' => $this->employee->getAllData()
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view(
            'admin.master_data.employee.create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        try {
            $data = $request->validated();
            Employee::create($data);
        } catch (\Exception $e) {
            return redirect(route('employee.index'))->with('error', 'Gagal Menambah Data' . $e->getMessage());
        }
        return redirect(route('employee.index'))->with('success', 'Berhasil Menambah Data');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        return view('admin.master_data.employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        try {
            $data = $request->validated();
            $employee->update($data);
        } catch (\Exception $e) {
            return redirect(route('employee.index'))->with('error', 'Gagal Edit Data Pegawai' . $e->getMessage());
        }
        return redirect(route('employee.index'))->with('success', 'Berhasil Edit Data Pegawai');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect(route('employee.index'))->with('success', 'Berhasil Hapus Data Pegawai');
    }
}