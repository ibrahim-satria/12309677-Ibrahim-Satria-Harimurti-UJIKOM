    <?php

    use App\Http\Controllers\AuthController;
    use App\Http\Controllers\CategoryController;
    use App\Http\Controllers\ItemController;
    use App\Http\Controllers\UserController;
    use App\Http\Controllers\LendingController;
    use Illuminate\Support\Facades\Route;

    // Landing
    Route::get('/', function () {
        return view('landing.index');
    });

    // ================= AUTH =================
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // ================= PROTECTED =================
    Route::middleware(['auth'])->group(function () {

        // Redirect dashboard sesuai role
        Route::get('/dashboard', function () {
            return auth()->user()->role === 'admin'
                ? redirect()->route('admin.dashboard')
                : redirect()->route('staff.dashboard');
        })->name('dashboard');

        // ================= ADMIN =================
        Route::middleware(['role:admin'])->group(function () {

            Route::get('/admin/dashboard', [CategoryController::class, 'dashboard'])
                ->name('admin.dashboard');

            // Categories
            Route::resource('admin/categories', CategoryController::class)->names([
                'index' => 'admin.categories.index',
                'create' => 'admin.categories.create',
                'store' => 'admin.categories.store',
                'show' => 'admin.categories.show',
                'edit' => 'admin.categories.edit',
                'update' => 'admin.categories.update',
                'destroy' => 'admin.categories.destroy',
            ]);

            // Items
            Route::resource('admin/items', ItemController::class)->names([
                'index' => 'admin.items.index',
                'create' => 'admin.items.create',
                'store' => 'admin.items.store',
                'show' => 'admin.items.show',
                'edit' => 'admin.items.edit',
                'update' => 'admin.items.update',
                'destroy' => 'admin.items.destroy',
            ]);

            Route::get('admin/items-export-xlsx', [ItemController::class, 'exportExcel'])
                ->name('admin.items.export_excel');

            Route::post('admin/items/{item}/add-damaged', [ItemController::class, 'addDamaged'])
                ->name('admin.items.add_damaged');

            // Users
            Route::resource('admin/users', UserController::class)->names([
                'index' => 'admin.users.index',
                'create' => 'admin.users.create',
                'store' => 'admin.users.store',
                'show' => 'admin.users.show',
                'edit' => 'admin.users.edit',
                'update' => 'admin.users.update',
                'destroy' => 'admin.users.destroy',
            ]);

            Route::get('admin/users-export-xlsx', [UserController::class, 'exportExcel'])
                ->name('admin.users.export_excel');

            Route::post('admin/users/{user}/change-password', [UserController::class, 'changePassword'])
                ->name('admin.users.change_password');
        });

        // ================= STAFF =================
        Route::middleware(['role:staff'])->group(function () {

            Route::get('/staff/dashboard', function () {
                return view('staff.dashboard');
            })->name('staff.dashboard');

         Route::get('staff/items', [ItemController::class, 'index'])
        ->name('staff.items.index');

            Route::get('staff/items-export-xlsx', [ItemController::class, 'exportExcel'])
                ->name('staff.items.export_excel');

            Route::resource('staff/lendings', LendingController::class)->names([
                'index' => 'staff.lendings.index',
                'create' => 'staff.lendings.create',
                'store' => 'staff.lendings.store',
                'show' => 'staff.lendings.show',
                'destroy' => 'staff.lendings.destroy',
            ]);

            Route::patch('staff/lendings/{lending}/return', [LendingController::class, 'markReturned'])
                ->name('staff.lendings.return');

            Route::get('staff/lendings-export-xlsx', [LendingController::class, 'exportExcel'])
                ->name('staff.lendings.export_excel');
        });

    });