<div class="dropdown open mr-2">
    <p class=" p-2" type="button" data-bs-toggle="dropdown"  aria-expanded="false">
        {{ $fullname }}
    </p>
    <ul class="dropdown-menu dropdown-menu-end">

        <li class="user-header">
            <p>
                {{ $fullname }} - Web Developer
                <small>Member since Nov. 2012</small>
            </p>
        </li>
        <li class="w-100">
            <div class="text-center">
                <a href="#" wire:click="DoLogout()" class="btn btn-sm btn-danger m-auto">Sign out</a>
            </div>
        </li>
    </ul>
</div>
