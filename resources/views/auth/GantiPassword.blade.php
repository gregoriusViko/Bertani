<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password</title>
    <link rel="stylesheet" href="css/final.css" />
</head>

<body>
    <div class="fixed inset-0 p-4 flex flex-wrap justify-center items-center w-full h-full z-[1000] before:fixed before:inset-0 before:w-full before:h-full before:bg-[rgba(0,0,0,0.5)] overflow-auto font-[sans-serif]"
        style="background-image: url('/img/bglogin.jpg');">

        <div class="w-full max-w-lg bg-green-400 shadow-lg rounded-lg p-8 relative opacity-80">

            <p class="text-black text-3xl font-bold py-8 text-center">Ganti Password</p>

            <form action="{{ route('password.update') }}" method="post" class="max-w-md mt-4 space-y-4 lg:mt-5 md:space-y-5">

                <label for="password" class="block mb-2 text-2xl font-semibold text-black">Ganti Password</label>
                <div class="relative flex items-center">
                    <input type="password" placeholder="Masukkan password baru" name="password" id="password"
                        class="px-4 py-2 bg-white text-gray-800 w-full text-sm border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
                    <button type="button" id="togglePassword"
                        class="absolute right-4 bg-transparent focus:outline-none">
                        <img id="eye" src="./img/eyeclosed.png" alt="Toggle Password" class="w-5 h-5">
                    </button>
                </div>

                <!-- <div class="py-4"></div> -->

                <label for="confirm_password" class="block mb-2 text-2xl font-semibold text-black">Konfirmasi
                    Password</label>
                <div class="relative flex items-center">
                    <input type="password" placeholder="Masukkan password kembali" name="confrim_password"
                        id="confirm_password"
                        class="px-4 py-2 bg-white text-gray-800 w-full text-sm border border-gray-300 focus:border-green-600 outline-none rounded-lg" />
                    <button type="submit" id="toggleConfirmPassword"
                        class="absolute right-4 bg-transparent focus:outline-none">
                        <img id="confirm_eye" src="./img/eyeclosed.png" alt="Toggle Password" class="w-5 h-5">
                    </button>
                </div>

                <div class="flex justify-between">
                    <a href=" {{ route('login') }}">
                        <button type="button"
                            class="mb-4 px-5 py-2.5 w-48 bg-black text-white text-sm rounded-lg tracking-wide mx-auto">Kembali
                        </button></a>

                    <button type="submit"
                        class="mb-4 px-5 py-2.5 w-48 bg-black text-white text-sm rounded-lg tracking-wide mx-auto">Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const togglePassword = document.querySelector("#togglePassword");
        const passwordField = document.querySelector("#password");
        const eye = document.querySelector("#eye");

        togglePassword.addEventListener("click", () => {
            // Toggle tipe attribute
            const type = passwordField.getAttribute("type") === "password" ? "text" : "password";
            passwordField.setAttribute("type", type);

            // Mengganti ikon eye 
            eye.src = type === "password" ? "./img/eyeclosed.png" : "./img/eyeopen.png";
        });

        const toggleConfirmPassword = document.querySelector("#toggleConfirmPassword");
        const confirmPasswordField = document.querySelector("#confirm_password");
        const confirmEye = document.querySelector("#confirm_eye");

        toggleConfirmPassword.addEventListener("click", () => {
            // Toggle tipe attribute
            const type = confirmPasswordField.getAttribute("type") === "password" ? "text" : "password";
            confirmPasswordField.setAttribute("type", type);

            // Mengganti ikon eye 
            confirmEye.src = type === "password" ? "./img/eyeclosed.png" : "./img/eyeopen.png";
        });
    </script>

</body>

</html>
