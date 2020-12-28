<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*----------- start : get method ----------*/
Route::group(['middleware' => 'prevent-back-history'],function(){
	

Route::get('/', 'MyAdminController@index');
Route::get('/dashboard', 'MyAdminController@Dashboard');
Route::get('/logout', 'MyAdminController@Logout');
Route::get('/check-compny', 'MyAdminController@CheckCompny');
Route::get('/form-mast-depot', 'MasterController@DepotForm');
Route::get('/view-mast-depot', 'MasterController@DepotView');
Route::get('/edit-depot/{id}', 'MasterController@EditDepotForm');

/*----------- start : fleet truck wheel form ----------*/

Route::get('/form-fleet-truck-wheel', 'MasterController@FleetTruckWheelForm');
Route::get('/view-flet-truck-wheel', 'MasterController@FleetTruckWhelView');
Route::get('/edit-flet-truck-wheel/{id}', 'MasterController@EditFleetTruckWhel');

/*----------- end : fleet truck wheel form ----------*/

/*----------- start : manufacturing form ----------*/

Route::get('/form-mast-manufacturing', 'MasterController@MastManufacturingForm');
Route::get('/view-manufature', 'MasterController@manufatureView');
Route::get('/edit-manufature/{id}', 'MasterController@EditManufactur');

/*----------- end : manufacturing form ----------*/

/*----------- start : dealer form ----------*/

Route::get('/form-mast-dealer', 'MasterController@DealerForm');
Route::get('/view-mast-dealer', 'MasterController@DealerView');
Route::get('/edit-dealer/{id}', 'MasterController@EditDealerForm');

/*----------- start : end dealer form ----------*/

/*----------- start : destinaton  form ----------*/

Route::get('/form-mast-destination', 'MasterController@DestinationForm');
Route::get('/view-mast-destination', 'MasterController@DestinationView');
Route::get('/edit-destination/{id}', 'MasterController@EditDestinationForm');


Route::get('/form-mast-transporter', 'MasterController@TransporterForm');
Route::get('/view-mast-transport','MasterController@TransporterView');
Route::get('/edit-transport/{id}','MasterController@EditTransporterForm');


Route::get('/form-mast-fleet', 'MasterController@FleetForm');

Route::get('/view-mast-fleet','MasterController@FleetView');

Route::get('/edit-fleet/{id}','MasterController@EditFleetForm');


Route::get('/form-mast-user', 'MasterController@UserForm');

Route::get('/view-mast-user', 'MasterController@UserView');

Route::get('/edit-user/{id}','MasterController@EditUserForm');


Route::get('/form-mast-fy', 'MasterController@FyForm');

Route::get('/view-mast-fy', 'MasterController@FyView');

Route::get('/edit-fy/{id}','MasterController@EditFyForm');


Route::get('/form-mast-company', 'MasterController@CompanyForm');

Route::get('/view-mast-company', 'MasterController@CompanyView');

Route::get('/edit-company/{id}','MasterController@EditCompanyForm');


Route::get('/form-mast-um', 'MasterController@UmForm');

Route::get('/view-mast-um', 'MasterController@UmView');

Route::get('/edit-um/{id}','MasterController@EditUmForm');


Route::get('/form-mast-item', 'MasterController@ItemForm');

Route::get('/view-mast-item', 'MasterController@ItemView');

Route::get('/edit-item/{id}','MasterController@EditItemForm');


Route::get('/form-mast-itemum', 'MasterController@ItemUmForm');

Route::get('/view-mast-itemum', 'MasterController@ItemUmView');

Route::get('/edit-itemum/{id}','MasterController@EditItemUmForm');


Route::get('/form-mast-rate', 'MasterController@RateForm');

Route::get('/view-mast-rate', 'MasterController@RateView');

Route::get('/edit-rate/{id}', 'MasterController@EditRateForm');

Route::post('userData','MasterController@OutwardSerach');


Route::get('/outward-dispatch','ReportMisController@OutwardDespatchReport');


Route::get('/profile','MasterController@Profile');





Route::get('/form-mast-account-type', 'MasterController@AccountTypeForm');

Route::get('/view-mast-account-type', 'MasterController@AccountTypeView');

Route::get('/edit-account-type/{id}','MasterController@EditAccountTypeForm');

/*----------- END : destinaton form ----------*/

/*start transaction And report / mis*/


Route::get('/form-inward-trans', 'TransactionController@InwardTrans');
Route::get('/form-outward-trans', 'TransactionController@OutwardTrans');
Route::get('/form-sap-bill', 'TransactionController@SapBill');



Route::get('/view-inward-trans', 'TransactionController@viewInwardTrnas');
Route::get('/view-sap-bill', 'TransactionController@viewSapBill');
Route::get('/view-all-data-inward-trans/{id}', 'TransactionController@viewAllDataInwardTrans');
Route::get('/view-outward-trans', 'TransactionController@viewOutwardTrans');

Route::get('edit-form-inward-trans/{id}', 'TransactionController@EditInwardTrans');
Route::get('edit-form-sap-bil/{id}', 'TransactionController@EditSapBill');
Route::get('edit-form-outward-trans/{id}', 'TransactionController@EditOutwardTrans');


Route::resource('/rept-sap-despatch', 'ReportMisController');
Route::get('/rept-sap-list', 'ReportMisController@ReportSapList');
Route::get('/rept-inward-sto-reg', 'ReportMisController@ReportInwardSto');

/*start transaction And report / mis*/

Route::get('/sap-stock', 'MyAdminController@sapStock');
Route::get('/actual-stock', 'MyAdminController@actualStock');

Route::get('/logistic/trpt-payment-advice', 'LogisticController@TrptPaymentAdvice');

Route::get('/trpt-payment', 'LogisticController@TrptPayment');



    /*------------------ end : get method ---------------------*/




    /*--------------------- start : post method --------------*/

Route::post('login', 'MyAdminController@login');
Route::post('company-submit', 'MyAdminController@CompanySubmit');
Route::post('form-mast-depot-save', 'MasterController@DepotFormSave');
Route::post('form-mast-depot-update', 'MasterController@DepotFormUpdate');
Route::post('form-mast-dealer-save', 'MasterController@DealerFormSave');
Route::post('form-mast-dealer-update', 'MasterController@DealerFormUpdate');

Route::post('form-mast-destination-save', 'MasterController@DestinationFormSave');

Route::post('form-mast-destination-update', 'MasterController@DestinationFormUpdate');

Route::post('delete-destination', 'MasterController@DeleteDestination');

Route::post('delete-depot', 'MasterController@DeleteDepot');

Route::post('delete-delaer', 'MasterController@DeleteDealer');

Route::post('delete-fleet', 'MasterController@DeleteFleet');

Route::post('delete-transport', 'MasterController@DeleteTransport');

Route::post('delete-user', 'MasterController@DeleteUser');

Route::post('delete-fy', 'MasterController@DeleteFy');

Route::post('delete-company', 'MasterController@DeleteCompany');

Route::post('delete-um', 'MasterController@DeleteUm');

Route::post('delete-rate', 'MasterController@DeleteRate');

Route::post('delete-item', 'MasterController@DeleteItem');

Route::post('delete-itemum', 'MasterController@DeleteItemUm');

Route::post('delete-acctype', 'MasterController@DeleteAccountType');


Route::post('form-mast-transport-save', 'MasterController@TransportFormSave');

Route::post('form-mast-transport-update', 'MasterController@TransportFormUpdate');


Route::post('form-mast-fleet-save', 'MasterController@FleetFormSave');
Route::post('form-mast-fleet-update', 'MasterController@FleetFormUpdate');


Route::post('form-mast-user-save','MasterController@UserFormSave');

Route::post('form-mast-user-update', 'MasterController@UserFormUpdate');


Route::post('form-mast-fy-save', 'MasterController@FyFormSave');
Route::post('form-mast-fy-update', 'MasterController@FyFormUpdate');

Route::post('form-mast-company-save','MasterController@CompanyFormSave');
Route::post('form-mast-company-update','MasterController@CompanyFormUpdate');


Route::post('form-mast-um-save', 'MasterController@UmFormSave');
Route::post('form-mast-um-update', 'MasterController@UmFormUpdate');

Route::post('form-mast-item-save','MasterController@ItemFormSave');
Route::post('form-mast-item-update', 'MasterController@ItemFormUpdate');

Route::post('form-mast-itemum-save','MasterController@ItemUmFormSave');
Route::post('form-mast-itemum-update', 'MasterController@ItemUmFormUpdate');

Route::post('form-mast-rate-save','MasterController@RateFormSave');
Route::post('form-mast-rate-update','MasterController@RateFormUpdate');

Route::post('form-mast-account-type-save','MasterController@AccountTypeFormSave');
Route::post('form-mast-account-type-update','MasterController@AccountTypeFormUpdate');

/*transaction And report /mis*/

Route::post('inward-trans-submit', 'TransactionController@SaveInwardTrans');
Route::post('item-um-aum', 'TransactionController@Item_UM_AUM');
Route::post('delete-inward-trans', 'TransactionController@DeleteInwardTrans');
Route::post('update-inward-trans', 'TransactionController@UpdateInwardTrans');

Route::post('sap-bill-submit', 'TransactionController@SaveSapBill');
Route::post('delete-sap-bill', 'TransactionController@DeleteSapBill');
Route::post('update-sap-bill', 'TransactionController@UpdateSapBill');

Route::post('outward-trans-submit', 'TransactionController@SaveOutwardTrans');
Route::post('delete-outward-trans', 'TransactionController@DeleteOutwardTrans');
Route::post('update-outward-trans', 'TransactionController@UpdateOutwardTrans');


Route::post('sap-despatch-search', 'ReportMisController@SapDespatchAjax');

Route::post('sap-list-search', 'ReportMisController@SapListSearchAjax');

Route::post('inward-sto-reg-search', 'ReportMisController@InwardStoSearchAjax');

Route::post('get-by-dpt-type', 'TransactionController@Dpt_Type_Ajax');


Route::post('access-control-save','MasterController@accessControl');

Route::post('access-control-update','MasterController@accessUpdateControl');

Route::post('get-umaum-show-in-edit', 'TransactionController@Get_UmAum_Show_In_Edit');


Route::post('get_comp', 'MyAdminController@GetCompny');



Route::post('fleet-truck-wheel-save', 'MasterController@FleetTruckWhelSave');
Route::post('fleet-truck-wheel-update', 'MasterController@fletTrucWhelUpdate');
Route::post('delete-fleet-truck-whel', 'MasterController@DeleteFletTruckWhel');

Route::post('manufacture-save', 'MasterController@ManufaturSave');
Route::post('delete-manufature', 'MasterController@Deletemanufature');
Route::post('manufature-update', 'MasterController@ManufacturUpdate');

/*transaction And report /mis*/


Route::post('fetch-otwardrecord-for-view', 'TransactionController@outward_data_fetch');

Route::post('fetch-inwardrecord-for-view', 'TransactionController@inward_data_fetch');

Route::post('fetch-sapbill-for-view', 'TransactionController@sap_bill_fetch');

      /*---------------end : post method-----------------*/





 /*-----*************** Start: Logistic Section ****************-----*/


 		/*--------- Start: Logistic Get Method ------------*/

 	Route::get('/logistic/fleet-transaction', 'LogisticController@index');

 	Route::get('/logistic/view-fleet-transaction', 'LogisticController@ViewFleetTrans');

 	Route::get('/logistic/edit-fleet-transaction/{id}', 'LogisticController@EditFleetForm');

 	Route::get('/logistic/fleet-challan-receipt', 'LogisticController@SubmitPartyBilReport');

 	Route::get('/logistic/edit-fleet-challan-receipt/{id}/{trdate}', 'LogisticController@EditChallanReceipt');

    Route::get('/logistic/trpt-bill-generate', 'LogisticController@PartyBillReport');

 	Route::get('/logistic/fleet-trans-report','LogisticController@FleetTransReport');

 	Route::get('/logistic/print-challan-receipt/{flitid}','LogisticController@PrinFletChalanRecept');

 	Route::get('/logistic/send-mail-for-party-bil/{party}','LogisticController@SendMailForPartyBil');

    Route::get('/logistic/fleet-certificate-transaction', 'LogisticController@FleetCertTrans');

    Route::get('/logistic/fleet-certificate-transaction-form', 'LogisticController@FleetCertTransForm');

    Route::get('/logistic/fleet-certificate-transaction-form-view', 'LogisticController@FleetCertTransFormView');

      Route::get('/logistic/fleet-certificate-report', 'LogisticController@FleetCertTransReport'); 


      Route::post('/logistic/get-certificate-data', 'LogisticController@FleetCertTransData');

 		/*--------- End: Logistic Get Method ------------*/





 		/*--------- Start: Logistic Post Method ------------*/


	Route::post('save-party-bil', 'LogisticController@SaveInPartyBill');

	Route::post('form-fleet-trans-save', 'LogisticController@FleetTransSave');

 	Route::post('form-fleet-trans-update', 'LogisticController@FleetTransUpdate');

 	Route::post('/fleet_rate', 'LogisticController@FleetRate');

 	Route::post('/delete-fleet-trans', 'LogisticController@DeleteFleetTrans');

 	Route::post('/update-fleet-challan-receipt', 'LogisticController@UpdateChallanReceipt');


 	Route::post('form-fleet-certificate-save', 'LogisticController@FleetCertTransFormSave');

  Route::post('/logistic/fleet-certificate-transaction-form-update', 'LogisticController@FleetCertTransFormUpdate');

  Route::get('/logistic/fleet-cert-report','LogisticController@FleetCertReport');



 	

 		/*--------- End: Logistic Post Method ------------*/






 /*-----*************** End: Logistic Section ****************-----*/










 /*-----*************** Start: Finance Section ****************-----*/


    /*--------- Start: Finance Get Method ------------*/

  Route::get('/finance/tax', 'FinanceMasterController@Tax');
  Route::get('/finance/view-tax', 'FinanceMasterController@ViewTax');
  Route::get('/finance/edit-tax/{id}', 'FinanceMasterController@EditTax');

  Route::get('/finance/glsch', 'FinanceMasterController@Glsch');
  Route::get('/finance/view-glsch', 'FinanceMasterController@ViewGlsch');
  Route::get('/finance/edit-glsch/{id}', 'FinanceMasterController@EditGlsch');

  Route::get('/finance/gl-mast', 'FinanceMasterController@GlMast');
  Route::get('/finance/view-gl-mast', 'FinanceMasterController@ViewGlMast');
  Route::get('/finance/edit-gl-mast/{id}', 'FinanceMasterController@EditGlMast');

  Route::get('/finance/item-category', 'FinanceMasterController@ItemCategory');
  Route::get('/finance/view-item-category', 'FinanceMasterController@ViewItemCategory');
  Route::get('/finance/edit-item-category/{id}', 'FinanceMasterController@EditItemCategory');

  Route::get('/finance/item-group', 'FinanceMasterController@ItemGroup');
  Route::get('/finance/view-item-group', 'FinanceMasterController@ViewItemGroup');
  Route::get('/finance/edit-item-group/{id}', 'FinanceMasterController@EditItemGroup');

  Route::get('/finance/tds-mast', 'FinanceMasterController@TDSMast');
  Route::get('/finance/view-tds-mast', 'FinanceMasterController@ViewTDSMast');
  Route::get('/finance/edit-tds-mast/{id}', 'FinanceMasterController@EditTDSMast');

  Route::get('/finance/tds-rate-mast', 'FinanceMasterController@TDSRateMast');
  Route::get('/finance/view-tds-rate-mast', 'FinanceMasterController@ViewTDSRateMast');
  Route::get('/finance/edit-tds-rate-mast/{id}', 'FinanceMasterController@EditTDSRateMast');


  Route::get('/finance/form-transaction-mast', 'FinanceMasterController@TransactionMaster');

  Route::get('/finance/view-mast-transaction', 'FinanceMasterController@ViewTransactionMast');


  Route::get('/finance/edit-transaction/{id}', 'FinanceMasterController@EditTransactionMast');



  Route::get('/finance/profit-center-mast', 'FinanceMasterController@ProfitCenterMaster');

  
  Route::get('/finance/view-mast-profit-center', 'FinanceMasterController@ViewProfitCenterMast');


  Route::get('/finance/edit-profit-center/{id}', 'FinanceMasterController@EditProfitCenterMast');



   Route::get('/finance/department-mast', 'FinanceMasterController@DepartmentMaster');

   Route::get('/finance/view-department-mast', 'FinanceMasterController@ViewDepartmentMast');


   Route::get('/finance/edit-department/{id}', 'FinanceMasterController@EditDepartmentMast');



    Route::get('/finance/edit-config/{id}', 'FinanceMasterController@EditConfigMast');


   Route::get('/finance/config-mast', 'FinanceMasterController@ConfigMaster');

  Route::get('/finance/view-config-mast', 'FinanceMasterController@ViewConfigMast');

  Route::get('/finance/tran-tax-mast', 'FinanceMasterController@TranTaxMaster');

   Route::get('/finance/view-tran-tax-mast', 'FinanceMasterController@ViewTranTaxMast');

   Route::get('/finance/edit-trans-tax/{id}', 'FinanceMasterController@EditTransTaxMast');

   Route::get('/finance/gl-key-mast', 'FinanceMasterController@GlKey');

   Route::get('/finance/view-gl-key-mast', 'FinanceMasterController@ViewGlKey');

   Route::get('/finance/edt-gl-key-mast/{id}', 'FinanceMasterController@EditGlKey');

    Route::get('/finance/form-plant-mast', 'FinanceMasterController@PlantMast');

   Route::get('/finance/view-mast-plant', 'FinanceMasterController@ViewPlantMast');

   Route::post('/finance/get_pfct', 'FinanceMasterController@GetPfctCode');

   Route::get('/finance/edit-plant/{id}', 'FinanceMasterController@EditPlantMast');


   Route::get('/finance/edit-valuation/{id}', 'FinanceMasterController@EditValuationMast');

   Route::get('/finance/edit-item-class/{id}', 'FinanceMasterController@EditItemClassMast');

   Route::get('/finance/edit-item-type/{id}', 'FinanceMasterController@EditItemTypeMast');

    Route::get('/finance/edit-rack/{id}', 'FinanceMasterController@EditRackMast');

    Route::get('/finance/edit-item-rack/{id}', 'FinanceMasterController@EditItemRackMast');

    Route::get('/finance/edit-acc-class/{id}', 'FinanceMasterController@EditAccClassMast');


   Route::get('/finance/form-mast-valuation', 'FinanceMasterController@ValuationMast');


   Route::get('/finance/view-mast-valuation', 'FinanceMasterController@ViewValuationMast');


   Route::get('/finance/form-mast-item-class', 'FinanceMasterController@ItemClassMast');

   Route::get('/finance/view-mast-item-class', 'FinanceMasterController@ViewItemClassMast');


    Route::get('/finance/form-mast-item-type', 'FinanceMasterController@ItemTypeMast');

   Route::get('/finance/view-mast-item-type', 'FinanceMasterController@ViewItemTypeMast');

   Route::get('/finance/form-mast-rack', 'FinanceMasterController@RackMast');

   Route::get('/finance/view-mast-rack', 'FinanceMasterController@ViewRackMast');


   Route::get('/finance/form-mast-item-rack', 'FinanceMasterController@ItemRackMast');

   Route::get('/finance/view-mast-item-rack', 'FinanceMasterController@ViewItemRackMast');

    Route::get('/finance/form-mast-acc-class', 'FinanceMasterController@AccClassMast');

   Route::get('/finance/view-mast-acc-class', 'FinanceMasterController@ViewAccClassMast');

    /*--------- End: Finance Get Method ------------*/





    /*--------- Start: Finance Post Method ------------*/


  Route::post('/form-tax-save', 'FinanceMasterController@SaveTax');
  Route::post('/delete-tax', 'FinanceMasterController@DeleteTax');
  Route::post('/form-tax-update', 'FinanceMasterController@UpdateTax');
  
  Route::post('/form-glsch-save', 'FinanceMasterController@SaveGlsch');
  Route::post('/delete-glsch', 'FinanceMasterController@DeleteGlsch');
  Route::post('/form-glsch-update', 'FinanceMasterController@UpdateGlsch');

  Route::post('/form-glmast-save', 'FinanceMasterController@SaveGlMast');
  Route::post('/delete-gl-mast', 'FinanceMasterController@DeleteGl');
  Route::post('/form-gl-mast-update', 'FinanceMasterController@UpdateGlMast');

  Route::post('/form-itemcategory-save', 'FinanceMasterController@SaveItemCategory');
  Route::post('/delete-item-category', 'FinanceMasterController@DeleteItemCategory');
  Route::post('/form-item-category-update', 'FinanceMasterController@UpdateItemCategory');

  Route::post('/form-itemgroup-save', 'FinanceMasterController@SaveItemGroup');
  Route::post('/delete-item-group', 'FinanceMasterController@DeleteItemgroup');
  Route::post('/form-item-group-update', 'FinanceMasterController@UpdateItemGroup');

  Route::post('/form-tdsmast-save', 'FinanceMasterController@SaveTDSMast');
  Route::post('/delete-tds-mast', 'FinanceMasterController@DeleteTDSMast');
  Route::post('/form-tds-mast-update', 'FinanceMasterController@UpdateTDSMast');


  Route::post('/form-tds-rate-mast-save', 'FinanceMasterController@SaveTDSRateMast');
  Route::post('/delete-tds-rate-mast', 'FinanceMasterController@DeleteTDSRateMast');
  Route::post('/form-tds-rate-mast-update', 'FinanceMasterController@UpdateTDSRateMast');


   Route::post('/finance/form-mast-transaction-save', 'FinanceMasterController@TransactionFormSave');


  Route::post('/finance/form-mast-transaction-update', 'FinanceMasterController@TransactionFormUpdate');


  Route::post('/finance/form-profit-center-save', 'FinanceMasterController@ProfitCenterFormSave');

  Route::post('/finance/form-profit-center-update', 'FinanceMasterController@ProfitCenterFormUpdate');


  Route::post('delete-pfct', 'FinanceMasterController@DeleteProfitCt');
  Route::post('delete-transaction', 'FinanceMasterController@DeleteTransaction');
  

  Route::post('/finance/form-mast-department-save', 'FinanceMasterController@DepartFormSave');
  
  Route::post('/finance/form-mast-department-update', 'FinanceMasterController@DepartmentFormUpdate');

  Route::post('delete-department', 'FinanceMasterController@DeleteDepartment');

   Route::post('/finance/delete-item-class', 'FinanceMasterController@DeleteItemClass');

  Route::post('/finance/delete-valuation', 'FinanceMasterController@DeleteValuation');

  Route::post('/finance/delete-config', 'FinanceMasterController@DeleteConfig');

  Route::post('/finance/delete-item-type', 'FinanceMasterController@DeleteItemType');

  Route::post('/finance/delete-rack', 'FinanceMasterController@DeleteRack');

  Route::post('/finance/delete-item_rack', 'FinanceMasterController@DeleteItemRack');

  Route::post('/finance/delete-acc-class', 'FinanceMasterController@DeleteAccClass');

  Route::post('/finance/form-mast-config-save', 'FinanceMasterController@ConfigFormSave');
  
  Route::post('/finance/form-mast-config-update', 'FinanceMasterController@ConfigFormUpdate');


  Route::post('/finance/form-mast-trantax-save', 'FinanceMasterController@TranTaxFormSave');

  Route::post('/finance/update-first-transtax', 'FinanceMasterController@UpdateFirstTransTaxMast');

  Route::post('/finance/update-second-transtax', 'FinanceMasterController@UpdateSecondTransTaxMast');

  Route::post('/finance/update-third-transtax', 'FinanceMasterController@UpdateThirdTransTaxMast');
  Route::post('delete-trans-tax-mast', 'FinanceMasterController@DeleteTranTax');

  Route::post('finance/form-mast-glkey-save', 'FinanceMasterController@SaveGlKey');
  Route::post('/delete-gl-key', 'FinanceMasterController@DeleteGlKey');

  Route::post('/finance/update-gl-keymast', 'FinanceMasterController@UpdateGlKey');

  Route::post('/finance/delete-plant', 'FinanceMasterController@DeletePlant');

   Route::post('/finance/form-mast-plant-save', 'FinanceMasterController@PlantFormSave');

   Route::post('/finance/form-mast-plant-save2', 'FinanceMasterController@PlantFormSave2');

   Route::post('/finance/form-mast-plant-save3', 'FinanceMasterController@PlantFormSave3');

   Route::post('/finance/form-mast-plant-update', 'FinanceMasterController@PlantFormUpdate');

   Route::post('/finance/form-mast-valuation-save', 'FinanceMasterController@ValuationFormSave');

   Route::post('/finance/form-mast-valuation-update', 'FinanceMasterController@ValuationFormUpdate');


   Route::post('/finance/form-mast-item-class-save', 'FinanceMasterController@ItemClassFormSave');

   Route::post('/finance/form-mast-item-class-update', 'FinanceMasterController@ItemClassFormUpdate');

   Route::post('/finance/form-mast-item-type-save', 'FinanceMasterController@ItemTypeFormSave');

   Route::post('/finance/form-mast-item-type-update', 'FinanceMasterController@ItemTypeFormUpdate');


   Route::post('/finance/form-mast-rack-save', 'FinanceMasterController@RackFormSave');

   Route::post('/finance/form-mast-rack-update', 'FinanceMasterController@RackFormUpdate');


   Route::post('/finance/form-mast-item-rack-save', 'FinanceMasterController@ItemRackFormSave');

   Route::post('/finance/form-mast-item-rack-update', 'FinanceMasterController@ItemRackFormUpdate');

   Route::post('/finance/form-mast-acc-class-save', 'FinanceMasterController@AccClassFormSave');

   Route::post('/finance/form-mast-acc-class-update', 'FinanceMasterController@AccClassFormUpdate');
    /*--------- End: Finance Post Method ------------*/








 /*-----*************** End: Finance Section ****************-----*/



 });