<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>PLN Nusa Daya - Asset Tracking Platform Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet"
  />
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap"
    rel="stylesheet"
  />
  <style>
    body {
      font-family: 'Inter', sans-serif;
      overflow: hidden;
    }
  </style>
</head>
<body>
  <div class="absolute top-0 left-0 p-8">
    <img
      src="{{ asset('images/logo.png') }}"
      alt="PLN Nusa Daya logo"
      class="w-30 h-20 object-contain"
    />
  </div>

  <div class="min-h-screen w-full flex flex-col md:flex-row">
    
    <div class="md:w-2/3 bg-[#f5f6f8] flex flex-col justify-center items-center p-6 md:p-12">
      <div class="w-full max-w-lg">
        <img
          src="{{ asset('images/jumbotron.png') }}"
          alt="Illustration of two workers in warehouse"
          class="w-full h-auto object-cover rounded-lg"
          width="450"
          height="200"
        />
      </div>
    </div>

    <div class="md:w-1/3 bg-white flex justify-center items-center p-6 md:p-10">
      <form
        class="bg-white w-full max-w-md"
        autocomplete="off"
        novalidate
      >
        <div class="text-center mb-6">
          <div class="text-xs text-gray-600 font-normal mb-1 uppercase tracking-widest">
            NUSA DAYA EXCELLENCE TOOLS
          </div>
          <h1 class="text-gray-900 font-extrabold text-xl">
            ASSET TRACKING PLATFORM
          </h1>
        </div>

        <label for="email" class="block text-xs font-normal text-gray-700 mb-1"
          >Email/NIP</label
        >
        <input
          id="email"
          name="email"
          type="text"
          placeholder="Email/NIP"
          class="w-full rounded-md border border-gray-300 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 px-3 py-2 mb-5 text-gray-500 placeholder-gray-400 outline-none"
          required
        />

        <label for="password" class="block text-xs font-normal text-gray-700 mb-1"
          >Password</label
        >
        <div class="relative mb-5">
          <input
            id="password"
            name="password"
            type="password"
            placeholder="..........."
            class="w-full rounded-md border border-gray-300 focus:border-blue-600 focus:ring-1 focus:ring-blue-600 px-3 py-2 pr-10 text-gray-700 placeholder-gray-400 outline-none"
            required
          />
          <button
            type="button"
            id="togglePassword"
            aria-label="Toggle password visibility"
            class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-gray-600"
            tabindex="-1"
          >
            <i class="fas fa-eye-slash"></i>
          </button>
        </div>
        <button
          type="submit"
          class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-md py-3"
        >
          Log in
        </button>
      </form>
    </div>
  </div>

  <script>
    // Pilih elemen tombol dan input password
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');
    const icon = togglePassword.querySelector('i');

    // Tambahkan event listener untuk klik pada tombol
    togglePassword.addEventListener('click', function (e) {
      // Toggle tipe input antara 'password' dan 'text'
      const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
      password.setAttribute('type', type);
      
      // Toggle ikon mata
      icon.classList.toggle('fa-eye-slash');
      icon.classList.toggle('fa-eye');
    });
  </script>

</body>
</html>