<div class="bg-dark text-white vh-100 p-3">

    <h3 class="text-center mb-4">

        📦 Inventory

    </h3>

    <ul class="nav flex-column">

        <li class="nav-item mb-2">

            <a href="{{ route('admin.dashboard') }}" class="nav-link text-white">

                <i class="bi bi-speedometer2"></i>

                Dashboard

            </a>

        </li>

        <li class="nav-item mb-2">

            <a href="{{ route("admin.categories.index") }}" class="nav-link text-white">

                <i class="bi bi-folder"></i>

                Categories

            </a>

        </li>

        <li class="nav-item mb-2">

            <a href="{{route("admin.suppliers.index")}}" class="nav-link text-white">

                <i class="bi bi-truck"></i>

                Suppliers

            </a>

        </li>

        <li class="nav-item mb-2">

            <a href="{{route("admin.products.index")}}" class="nav-link text-white">

                <i class="bi bi-box"></i>

                Products

            </a>

        </li>

        <li class="nav-item mb-2">

            <a href="#" class="nav-link text-white">

                <i class="bi bi-cart-plus"></i>

                Purchases

            </a>

        </li>

        <li class="nav-item mb-2">

            <a href="#" class="nav-link text-white">

                <i class="bi bi-cart-check"></i>

                Sales

            </a>

        </li>

        <li class="nav-item mt-4">

            <a href="{{ route('logout') }}" class="btn btn-danger w-100">

                Logout

            </a>

        </li>

    </ul>

</div>