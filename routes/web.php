<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\BranchRequisitionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\ReceiveOrderController;
use App\Http\Controllers\ItemInventoryController;
use App\Http\Controllers\StocketTransferController;

use App\Http\Middleware\Auth;






/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {

    return view('dashboard');
})->middleware(Auth::class);

// Users
Route::get('/Login', [UserController::class, 'Login']);

Route::get('/get-users-by-roles', [UserController::class, 'GetUserbyRole']);

Route::get('/get-all-users', [UserController::class, 'GetAllUser']);
//
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// testing detail
Route::any('/details/{reqno}', [BranchRequisitionController::class, 'DetailsPage'])->middleware(Auth::class);
//Requisition
Route::get('/create-requisition', [BranchRequisitionController::class, 'RequisitionPage'])->middleware(Auth::class);

Route::get('/request-requisition', [BranchRequisitionController::class, 'RequisitionRequestPage'])->middleware(Auth::class);

Route::get('/get-requisition-details/{reqno}', [BranchRequisitionController::class, 'RequisitionDetailsPage'])->middleware(Auth::class);

Route::post('/add-requisition', [BranchRequisitionController::class, 'AddRequisition']);

Route::post('/update-requisition', [BranchRequisitionController::class, 'updateRequisition']);

Route::post('/update-requisition-orderline', [BranchRequisitionController::class, 'UpdateOrderlines']);

Route::get('/list-requisition', [BranchRequisitionController::class, 'RequisitionListPage'])->middleware(Auth::class);

Route::get('/list-requisition-approvals/{dept_id}', [BranchRequisitionController::class, 'getRequisitionApprovals']);

Route::get('/get-requisition/{bid}/{req_no}', [BranchRequisitionController::class, 'getRequisition']);

Route::get('/get-my-requisition', [BranchRequisitionController::class, 'getMyRequisition']);

Route::get('/get-all-requisition', [BranchRequisitionController::class, 'getAllRequisition']);

Route::post('/approved-requisition', [BranchRequisitionController::class, 'RequisitionApprovals']);

Route::post('/noted-requisition', [BranchRequisitionController::class, 'RequisitionNoted']);

Route::post('/requisition-final/{reqid}', [BranchRequisitionController::class, 'RequisitionFinal']);

Route::get('/list-requisition-orders', [BranchRequisitionController::class, 'RequisitionOrdersPage'])->middleware(Auth::class);

Route::get('/requisition-orders/{dept_id}', [BranchRequisitionController::class, 'getRequisitionOrders']);

Route::post('/update-requisition-status', [BranchRequisitionController::class, 'UpdateStatus']);

// Purchase Order
Route::get('/create-purchase-order', [PurchaseOrderController::class, 'PurchaseOrderPage'])->middleware(Auth::class);

Route::get('/list-purchase-order', [PurchaseOrderController::class, 'POList'])->middleware(Auth::class);

Route::get('/purchase-order-details/{pono}', [PurchaseOrderController::class, 'PODetailsPage'])->middleware(Auth::class);

Route::get('/purchase-order-request', [PurchaseOrderController::class, 'PORequests'])->middleware(Auth::class);

Route::get('/purchase-details/{pono}', [PurchaseOrderController::class, 'DetailsPage'])->middleware(Auth::class);

Route::get('/for-purchase-order', [PurchaseOrderController::class, 'ForPOOrderline']);

Route::get('/get-purchase-order', [PurchaseOrderController::class, 'GetPoList']);

Route::get('/get-purchase-order-request', [PurchaseOrderController::class, 'GetPORequest']);

Route::get('/get-all-branch-requisition', [PurchaseOrderController::class, 'GetBranchRequisitions'])->middleware(Auth::class);

Route::get('/list-all-branch-requisition', [PurchaseOrderController::class, 'getAllRequisition']);

Route::get('/get-po-attachments', [PurchaseOrderController::class, 'getPOAttachments']);

Route::post('/add-purchase-order', [PurchaseOrderController::class, 'AddPurchaseOrder']);

Route::post('/update-purchase-order', [PurchaseOrderController::class, 'UpdatePurchaseOrder']);

Route::post('/update-purchase-order-items', [PurchaseOrderController::class, 'UpdateOrderline']);

Route::post('/approved-purchase-order', [PurchaseOrderController::class, 'ApprovedPO']);

Route::post('/update-purchase-order-status', [PurchaseOrderController::class, 'UpdateStatus']);

Route::post('/attach-po-atp-file', [PurchaseOrderController::class, 'AttachATPFile']);
//logs
Route::get('/get-po-logs/{poid}', [PurchaseOrderController::class, 'getPologs']);


///add items to inventory to prepare for receiving the item
Route::post('/add-to-inventory', [PurchaseOrderController::class, 'AddToInventory']);
//
//orderline
Route::get('/get-order-line/{pono}/{reqno}', [BranchRequisitionController::class, 'getOrderline']);
//
// Receiving
Route::get('/receive-order-page', [ReceiveOrderController::class, 'ReceivingOrderPage'])->middleware(Auth::class);

Route::get('/receive-stock-page/{encrypted}', [ReceiveOrderController::class, 'ReceivingStockPage'])->middleware(Auth::class);

Route::get('/stock-transfer-list-page', [ReceiveOrderController::class, 'ReceivingStockTransferListPage'])->middleware(Auth::class);

Route::get('/get-po-for-receiving', [ReceiveOrderController::class, 'getOrderLineForReceiving']);

Route::post('/add-receiving-order', [ReceiveOrderController::class, 'addRecevingItem']);

Route::get('/list-receiving-order', [ReceiveOrderController::class, 'ReceivingOrderListPage'])->middleware(Auth::class);

Route::post('/update-receiving-details', [ReceiveOrderController::class, 'UpdateReceiveDetails']);

Route::post('/update-receiving-order-items', [ReceiveOrderController::class, 'UpdateReceiveOrderItems']);

Route::get('/get-receiving-orders', [ReceiveOrderController::class, 'GetReceiving']);

Route::get('/receiving-orders-details/{drno}', [ReceiveOrderController::class, 'ReceivingOrderDetailsPage'])->middleware(Auth::class);

Route::get('/receiving-details/{drno}', [ReceiveOrderController::class, 'DetailsPage']);

Route::get('/receiving-orders-list/{drno}', [ReceiveOrderController::class, 'GetReceivingOrders']);

Route::post('/approved-receiving-details', [ReceiveOrderController::class, 'ApproveReceiveDetails']);

Route::get('/get-orderline-items/{olid}', [ReceiveOrderController::class, 'getOrderlineItems']);

Route::get('/get-receive-items/{rid}', [ReceiveOrderController::class, 'getReceivingItems']);

Route::get('/get-receive-origin-page', [ReceiveOrderController::class, 'ReceivingOriginPage'])->middleware(Auth::class);

//receiving logs
Route::get('/get-receiving-logs/{logs_id}', [ReceiveOrderController::class, 'getReceivingLogs']);
//
Route::post('/update-receiving-status', [ReceiveOrderController::class, 'UpdateReceivingStatus']);

// receive from Origin

Route::post('/add-receiving-origin', [ReceiveOrderController::class, 'addReceiveFromOrigin']);



///// stock transfer pages
Route::get('/stock-transfer-page', [StocketTransferController::class, 'StockTransferPage'])->middleware(Auth::class)->name('Stock Transfer page');

Route::get('/in-transit-list-page', [StocketTransferController::class, 'IntransitListPage'])->middleware(Auth::class);

Route::get('/in-transit-details-page/{intransit_no}', [StocketTransferController::class, 'IntransitDetailsPage'])->middleware(Auth::class);
///POST
Route::post('/add-stock-transfer', [StocketTransferController::class, 'addStockTransfer']);

Route::post('/approve-stock-transfer', [StocketTransferController::class, 'approvedStockTransfer']);

Route::post('/update-in-transit-items', [StocketTransferController::class, 'updateIntransitItems']);

Route::post('/update-in-transit-status', [StocketTransferController::class, 'updateIntransitStatus']);

Route::post('/update-stock-transfer-details', [StocketTransferController::class, 'updateIntransitDetails']);

Route::post('/update-intransit-receiving-details', [StocketTransferController::class, 'UpdateIntransitReceivingDetails']);

Route::post('/approve-intransit-receiving-details', [StocketTransferController::class, 'approvedStockTransferReceivingDetails']);
///GET
Route::get('/get-in-transit-list/{from}', [StocketTransferController::class, 'getIntransitList']);

Route::get('/get-receiving-in-transit-list/{to_dept}', [StocketTransferController::class, 'getReceivingIntransitList']);

Route::get('/get-in-transit-items/{stid}', [StocketTransferController::class, 'getIntransitItems']);

Route::get('/get-in-transit-logs/{st_id}', [StocketTransferController::class, 'getIntransitLogs']);
//items
Route::get('/tools-items', [ToolsController::class, 'ItemsPage'])->middleware(Auth::class);

Route::post('/add-items', [ToolsController::class, 'AddItem']);

Route::get('/get-items', [ToolsController::class, 'GetItem']);
//group
Route::get('/tools-group', [ToolsController::class, 'GroupPage'])->middleware(Auth::class);

Route::post('/add-group', [ToolsController::class, 'AddGroup']);

Route::get('/get-group', [ToolsController::class, 'GetGroup']);
// Business unit
Route::get('/tools-business-unit', [ToolsController::class, 'GroupPage'])->middleware(Auth::class);

Route::post('/add-business-unit', [ToolsController::class, 'AddGroup']);

Route::get('/get-business-unit', [ToolsController::class, 'GetGroup']);
//department
Route::get('/tools-department', [ToolsController::class, 'DepartmentPage'])->middleware(Auth::class);

Route::post('/add-department', [ToolsController::class, 'AddDepartment']);

Route::get('/get-department', [ToolsController::class, 'GetDepartment']);


// user
Route::get('/create-user', [UserController::class, 'CreateUser'])->middleware(Auth::class);

Route::post('/auth-user', [UserController::class, 'Auth']);

Route::post('/add-user', [UserController::class, 'AddUser']);

Route::post('/update-user-details', [UserController::class, 'UpdateUser']);

Route::post('/update-user-roles', [UserController::class, 'UpdateUserRoles']);

Route::post('/assign-user-roles', [UserController::class, 'AssignUserRoles']);

Route::get('/list-user', [UserController::class, 'UsersList']);

Route::get('/logout', [UserController::class, 'Logout']);


// supplier
Route::get('/tools-supplier', [ToolsController::class, 'SupplierPage'])->middleware(Auth::class);

Route::post('/add-supplier', [ToolsController::class, 'AddSupplier']);

Route::get('/get-supplier', [ToolsController::class, 'GetSupplier']);
// business unit
Route::get('/tools-business-unit', [ToolsController::class, 'BUPage'])->middleware(Auth::class);

Route::post('/add-business-unit', [ToolsController::class, 'AddBu']);

Route::get('/get-business-unit', [ToolsController::class, 'GetBu']);

// company
Route::get('/tools-company', [ToolsController::class, 'CompanyPage'])->middleware(Auth::class);

Route::post('/add-company', [ToolsController::class, 'AddCompany']);

Route::get('/get-company', [ToolsController::class, 'GetCompany']);

// employee
Route::get('/tools-employee', [ToolsController::class, 'EmployeePage'])->middleware(Auth::class);

Route::post('/add-employee', [ToolsController::class, 'AddEmployee']);

Route::get('/get-employee/{dept_id}', [ToolsController::class, 'GetAllEmployees']);

Route::get('/get-employee-details/{emp_id}', [ToolsController::class, 'EmployeeDetailsPage'])->middleware(Auth::class);

// inventory
Route::get('/inventory', [ItemInventoryController::class, 'ListInventoryPage'])->middleware(Auth::class);

Route::get('/get-inventory/{bid}', [ItemInventoryController::class, 'GetInventory']);

Route::get('/get-inventory-summary/{bid}', [ItemInventoryController::class, 'GetInventorySummary']);

Route::get('/get-approved-items/{bid}', [ItemInventoryController::class, 'GetApprovedItems']);

Route::post('/assign-item', [ItemInventoryController::class, 'AssignInventoryItem']);
//status
Route::get('/get-status/{stage}', [ToolsController::class, 'GetStatus']);
//Requisition Logs
Route::get('/get-requisition-logs/{reqid}', [BranchRequisitionController::class, 'getRequisitionLogs']);
//employee
Route::get('/get-employees', [ToolsController::class, 'GetEmployees']);



















