<?php
//routes/api.php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\AuthController;
//
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\PermissionController;

//
use App\Http\Controllers\API\ProfileController;
use App\Http\Controllers\API\DoctorController;
use App\Http\Controllers\API\LawyerController;
use App\Http\Controllers\API\StoreController;
use App\Http\Controllers\API\AssociationController;
use App\Http\Controllers\API\ProductController;

//
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\NewsController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\LikeController;

  
// -------------------- Rutas públicas -----------------------//
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Rutas de prueba de transacciones sin autenticación (puedes comentarlas luego de testear) 


Route::get('/productos',         [ProductController::class, 'index']);
Route::post('/productos',        [ProductController::class, 'store']);
Route::get('/productos/{id}',    [ProductController::class, 'show']);
Route::put('/productos/{id}',    [ProductController::class, 'update']);
Route::delete('/productos/{id}', [ProductController::class, 'destroy']);


// ---------- Rutas protegidas ---------- //



// esto es para 

// Route::middleware(['auth:sanctum', 'permission:manage permissions'])->group(function () {

Route::middleware('auth:sanctum')->group(function () {

    // Auth
    Route::get('/me',      [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    // Rutas protegidas por rol
    Route::get('/admin/dashboard', function () {
        return response()->json(['message' => 'Bienvenido Admin']);
    })->middleware('role:admin');

    // Rutas protegidas por permiso

    Route::get('/reportes', function () {
        return response()->json(['message' => 'Vista de reportes']);
    })->middleware('permission:ver reportes');



    // Listar todos los roles
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    // Crear nuevo rol
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store');
    // Ver un rol específico
    Route::get('roles/{role}', [RoleController::class, 'show'])->name('roles.show');
    // Actualizar un rol
    Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update');
    Route::patch('roles/{role}', [RoleController::class, 'update'])->name('roles.update.partial');
    // Eliminar un rol
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy');
    
    //listar endpoints

    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index');
    Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store');
    Route::get('permissions/{permission}', [PermissionController::class, 'show'])->name('permissions.show');
    Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update');
    Route::patch('permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update.partial');
    Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy');

});


Route::apiResource('profiles', ProfileController::class);
Route::apiResource('doctors', DoctorController::class);
Route::apiResource('lawyers', LawyerController::class);
Route::apiResource('stores', StoreController::class);
Route::apiResource('associations', AssociationController::class);

Route::apiResource('products', ProductController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('news', NewsController::class);
Route::apiResource('comments', CommentController::class)->only(['index', 'store', 'destroy']);
Route::post('likes', [LikeController::class, 'store']);
Route::delete('likes/{like}', [LikeController::class, 'destroy']);

// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/verify-account', [AuthController::class, 'verifyAccount']);
// Route::post('/login', [AuthController::class, 'login']);

// Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
// Route::post('/verify-reset-code', [AuthController::class, 'verifyResetCode']);
// Route::post('/reset-password', [AuthController::class, 'resetPassword']);

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/me', [AuthController::class, 'profile']);
//     Route::get('/verify-token', [AuthController::class, 'verifyToken']);
//     Route::post('/logout', [AuthController::class, 'logout']);
// });