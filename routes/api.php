<?php

use Illuminate\Support\Facades\Route;
use Module\Procurement\Http\Controllers\DashboardController;
use Module\Procurement\Http\Controllers\ProcurementMemberController;
use Module\Procurement\Http\Controllers\ProcurementAuctionController;
use Module\Procurement\Http\Controllers\ProcurementBiodataController;
use Module\Procurement\Http\Controllers\ProcurementDocumentController;
use Module\Procurement\Http\Controllers\ProcurementWorkunitController;
use Module\Procurement\Http\Controllers\ProcurementWorkgroupController;

Route::get('dashboard', [DashboardController::class, 'index']);

Route::post('auction/{procurementAuction}/restore', [ProcurementAuctionController::class, 'restore']);
Route::delete('auction/{procurementAuction}/force-delete', [ProcurementAuctionController::class, 'forceDelete']);
Route::resource('auction', ProcurementAuctionController::class)->parameters([
    'auction' => 'procurementAuction'
]);

Route::post('biodata/{procurementBiodata}/restore', [ProcurementBiodataController::class, 'restore']);
Route::delete('biodata/{procurementBiodata}/force-delete', [ProcurementBiodataController::class, 'forceDelete']);
Route::resource('biodata', ProcurementBiodataController::class)->parameters([
    'biodata' => 'procurementBiodata'
]);

Route::post('document/{procurementDocument}/restore', [ProcurementDocumentController::class, 'restore']);
Route::delete('document/{procurementDocument}/force-delete', [ProcurementDocumentController::class, 'forceDelete']);
Route::resource('document', ProcurementDocumentController::class)->parameters([
    'document' => 'procurementDocument'
]);

Route::post('workgroup/{procurementWorkgroup}/restore', [ProcurementWorkgroupController::class, 'restore']);
Route::delete('workgroup/{procurementWorkgroup}/force-delete', [ProcurementWorkgroupController::class, 'forceDelete']);
Route::resource('workgroup', ProcurementWorkgroupController::class)->parameters([
    'workgroup' => 'procurementWorkgroup'
]);

Route::post('workgroup/{procurementWorkgroup}/member/{procurementMember}/restore', [ProcurementMemberController::class, 'restore']);
Route::delete('workgroup/{procurementWorkgroup}/member/{procurementMember}/force-delete', [ProcurementMemberController::class, 'forceDelete']);
Route::resource('workgroup.member', ProcurementMemberController::class)->parameters([
    'workgroup' => 'procurementWorkgroup',
    'member' => 'procurementMember'
]);

Route::post('workunit/{procurementWorkunit}/restore', [ProcurementWorkunitController::class, 'restore']);
Route::delete('workunit/{procurementWorkunit}/force-delete', [ProcurementWorkunitController::class, 'forceDelete']);
Route::resource('workunit', ProcurementWorkunitController::class)->parameters([
    'workunit' => 'procurementWorkunit'
]);
