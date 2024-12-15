<div class="p-6">
    <a href="index.html" class="block mb-8">
        <img class="h-6 block dark:hidden" src="assets/images/logo-dark.png" alt="">
        <img class="h-6 hidden dark:block" src="assets/images/logo-light.png" alt="">
    </a>

    <div class="mb-4">
        <label class="block text-sm font-bold text-gray-600 dark:text-gray-200 mb-2">الاسم</label>
        <input id="LoggingEmailAddress" class="form-input" type="email" placeholder="Enter your email"  wire:model="name">
    </div>

    <div class="mb-4">
        <label class="block text-sm font-bold text-gray-600 dark:text-gray-200 mb-2" for="loggingPassword" >كلمة المرور</label>
        <input id="loggingPassword" class="form-input" type="password" placeholder="Enter your password" wire:model="password">
    </div>
    <div class="flex justify-center mb-6">
        <button class="btn w-full text-white bg-primary font-bold" wire:click="login"> سجل دخول </button>
    </div>
</div>