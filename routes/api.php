<?php

use Illuminate\Support\Facades\Route;
use Module\Procurement\Http\Controllers\DashboardController;
use Module\Procurement\Http\Controllers\ProcurementMemberController;
use Module\Procurement\Http\Controllers\ProcurementAuctionController;
use Module\Procurement\Http\Controllers\ProcurementBiodataController;
use Module\Procurement\Http\Controllers\ProcurementHistoryController;
use Module\Procurement\Http\Controllers\ProcurementOfficerController;
use Module\Procurement\Http\Controllers\ProcurementDocumentController;
use Module\Procurement\Http\Controllers\ProcurementWorkunitController;
use Module\Procurement\Http\Controllers\ProcurementWorkgroupController;

Route::get('dashboard', [DashboardController::class, 'index']);
Route::get('report', [DashboardController::class, 'report']);

Route::put('auction/{procurementAuction}/submitted', [ProcurementAuctionController::class, 'submitted']);
Route::put('auction/{procurementAuction}/qualified', [ProcurementAuctionController::class, 'qualified']);
Route::put('auction/{procurementAuction}/rejected', [ProcurementAuctionController::class, 'rejected']);
Route::put('auction/{procurementAuction}/verified', [ProcurementAuctionController::class, 'verified']);
Route::put('auction/{procurementAuction}/aborted', [ProcurementAuctionController::class, 'aborted']);
Route::put('auction/{procurementAuction}/avaluated', [ProcurementAuctionController::class, 'avaluated']);

Route::put('auction/{procurementAuction}/restore', [ProcurementAuctionController::class, 'restore']);
Route::delete('auction/{procurementAuction}/force', [ProcurementAuctionController::class, 'forceDelete']);
Route::resource('auction', ProcurementAuctionController::class)->parameters([
    'auction' => 'procurementAuction'
]);

Route::put('history/{procurementHistory}/restore', [ProcurementHistoryController::class, 'restore']);
Route::delete('history/{procurementHistory}/force', [ProcurementHistoryController::class, 'forceDelete']);
Route::resource('history', ProcurementHistoryController::class)->parameters([
    'history' => 'procurementHistory'
]);

Route::put('biodata/{procurementBiodata}/restore', [ProcurementBiodataController::class, 'restore']);
Route::delete('biodata/{procurementBiodata}/force', [ProcurementBiodataController::class, 'forceDelete']);
Route::resource('biodata', ProcurementBiodataController::class)->parameters([
    'biodata' => 'procurementBiodata'
]);

Route::put('document/{procurementDocument}/restore', [ProcurementDocumentController::class, 'restore']);
Route::delete('document/{procurementDocument}/force', [ProcurementDocumentController::class, 'forceDelete']);
Route::resource('document', ProcurementDocumentController::class)->parameters([
    'document' => 'procurementDocument'
]);

Route::put('workgroup/{procurementWorkgroup}/restore', [ProcurementWorkgroupController::class, 'restore']);
Route::delete('workgroup/{procurementWorkgroup}/force', [ProcurementWorkgroupController::class, 'forceDelete']);
Route::resource('workgroup', ProcurementWorkgroupController::class)->parameters([
    'workgroup' => 'procurementWorkgroup'
]);

Route::put('workgroup/{procurementWorkgroup}/member/{procurementMember}/restore', [ProcurementMemberController::class, 'restore']);
Route::delete('workgroup/{procurementWorkgroup}/member/{procurementMember}/force', [ProcurementMemberController::class, 'forceDelete']);
Route::resource('workgroup.member', ProcurementMemberController::class)->parameters([
    'workgroup' => 'procurementWorkgroup',
    'member' => 'procurementMember'
]);

Route::put('workunit/{procurementWorkunit}/restore', [ProcurementWorkunitController::class, 'restore']);
Route::delete('workunit/{procurementWorkunit}/force', [ProcurementWorkunitController::class, 'forceDelete']);
Route::resource('workunit', ProcurementWorkunitController::class)->parameters([
    'workunit' => 'procurementWorkunit'
]);

Route::put('workunit/{procurementWorkunit}/restore', [ProcurementOfficerController::class, 'restore']);
Route::delete('workunit/{procurementWorkunit}/force', [ProcurementOfficerController::class, 'forceDelete']);
Route::resource('workunit.officer', ProcurementOfficerController::class)->parameters([
    'workunit' => 'procurementWorkunit',
    'officer' => 'procurementOfficer'
]);
