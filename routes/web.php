<?php

use App\Http\Livewire\Categoria;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Perfil;
use App\Http\Livewire\Productos;
use App\Http\Livewire\Usuarios;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// -----------------------------------------------------------------------------
//   PDF 
// Route::get('/pdf', function () {
//     $pdf = App::make('dompdf.wrapper');

//     $pdf->loadHTML('<h1>Hola pdf</h1>');

//     return $pdf->stream();
// });

// Route::get('/pdf', function () {
//     $pdf = App('dompdf.wrapper');

//     $pdf->loadHTML('<h1>Hola pdf</h1>');

//     return $pdf->stream();
// });

// Route::get('/pdf', function () {

//         $pdf = Pdf::loadHTML('<h1>Hola pdf</h1>');
    
//         return $pdf->stream();
//     });

// Route::get('/pdf',function(){ return view('pdf.pdf'); });
// -----------------------------------------------------------------------------


Auth::routes();
// Auth::routes(['register' => false]);


Route::get('/',function(){ return redirect('login'); });


// supbase 


Route::group(['middleware' => ['auth']], function (){
        Route::get('/productos', Productos::class)->name('productos');
        Route::get('/categoria', Categoria::class)->name('categoria');
        Route::get('/usuarios', Usuarios::class)->name('usuarios');
        Route::get('/perfil', Perfil::class)->name('perfil');
        Route::get('/dashbaord', Dashboard::class)->name('dashbaord');
});


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
