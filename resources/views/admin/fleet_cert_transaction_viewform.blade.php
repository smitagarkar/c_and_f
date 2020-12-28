

  
<?php foreach($vehicleData as $key) { ?>
<style type="text/css">
  .alert {
  margin-bottom: 1px;
  height: 30px;
  line-height:30px;
  padding:0px 15px;
}
.alert h4 {
    margin-top: 5px;
    color: inherit;
}
.hidemsg{
  display: none;
}
</style> 
  <section class="content  boxclass"  style="margin-top: -4%;">

     <div class="box box-primary Custom-Box">

            <div class="box-header with-border">

              <div class="alert alert-success alert-dismissible hidemsg" id="showmsg_<?php echo $key['id'] ?>">

                 <button type="button" class="close" data-dismiss="alert" aria-hidden="true" style="padding-right: 2%;
    margin-top: 6px;">×</button>

              <h4>

              <i class="icon fa fa-check"></i>

                  Success...! Data was updated successfully....!

              </h4>
                
          </div>


            </div><!-- /.box-header -->

          
            <div class="box-body">
      
               @csrf

               <div class="row">

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Truck No:
                         

                        <span class="required-field"></span>

                      </label>

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-truck"></i></span>

                          <input type="text" class="form-control" name="truck_no" placeholder="Enter Truck No" value="{{ $key['truck_no'] }}" readonly="">

                        </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('truck_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>



                    </div>

                    <!-- /.form-group -->

                  </div>



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Certificate Code : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-file"></i></span>

                          <select class="form-control" name="cert_code" disabled="">
                             <option value='CF' <?php if($key['certificate_code']=='CF'){ echo 'selected';} ?> >CF - [Certificate Of Fitness]</option>
                            <option value='S-Permit' <?php if($key['certificate_code']=='S-Permit'){ echo 'selected';} ?>  >S-Permit - [State Permit]</option>
                            <option value='N-Permit' <?php if($key['certificate_code']=='N-Permit'){ echo 'selected';} ?> > N-Permit - [National Permit]</option>
                            <option value='RTO' <?php if($key['certificate_code']=='RTO'){ echo 'selected';} ?> > RTO - [RTO Tax] </option>
                            <option value='Danta' <?php if($key['certificate_code']=='Danta'){ echo 'selected';} ?> > Danta - [Danta Tax] </option>
                            <option value='Insurance' <?php if($key['certificate_code']=='Insurance'){ echo 'selected';} ?> > Insurance - [Vehicle Insurance] </option>
                            <option value='Pollution' <?php if($key['certificate_code']=='Pollution'){ echo 'selected';} ?> > Pollution - [PUC] </option>
                          </select>
                          

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('cert_code', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>



                  

                <!-- /.col -->

                

              </div>

              <!-- /.row -->



              <div class="row">



                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Certificate Number : 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-sort-numeric-asc"></i></span>

                          <input type="text" class="form-control Number" name="cert_no" value="{{ $key['certificate_no']}}" placeholder="Enter Certificate Number" maxlength="10" readonly="">

                      </div> 

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('cert_no', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                

                  <div class="col-md-6">

                    <div class="form-group">

                      <label>

                       Certificate Date

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input type="text" class="form-control" name="cert_date" value="{{ $key['certificate_date']}}" placeholder="Enter Certificate Date" readonly="">

                      </div>

                          <small id="emailHelp" class="form-text text-muted">

                            {!! $errors->first('cert_date', '<p class="help-block" style="color:red;">:message</p>') !!}

                          </small>

                    </div>

                    <!-- /.form-group -->

                  </div>

                <!-- /.col -->

                

              </div>

              <!-- /.row -->





              <div class="row">

                 <div class="col-md-6">

                    <div class="form-group">

                      <label>

                        Certificate Renew: 

                        <span class="required-field"></span>

                      </label>

                      
                       <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-file"></i></span>
                         <input type="text" name="cert_rnew" class="form-control" placeholder="Enter Certificate Renew" value="{{ $key['certificate_renew'] }}">
                      </div>
                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('cert_rnew', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      
                      

                    </div>
                  </div>
                    <!-- /.form-group -->

                    <div class="col-md-6">
                     <div class="form-group">

                      <label>

                        Certificate Renew Date: 

                        <span class="required-field"></span>

                      </label>

                      <div class="input-group">

                          <span class="input-group-addon">

                            <i class="fa fa-calendar" aria-hidden="true"></i>

                          </span>
                        
                        
                       <input name="cert_rnew_dt" class="form-control datepicker" id="cert_rnew_dt_<?php echo $key['id'] ?>" placeholder="Enter Certificate Renew Date" value="{{ $key['cert_renew_date'] }}" >

                      </div>

                      <small id="emailHelp" class="form-text text-muted">

                        {!! $errors->first('cert_rnew_dt', '<p class="help-block" style="color:red;">:message</p>') !!}

                      </small>

                      

                    </div>


                  </div>

              </div>

              <div style="text-align: center;">

                 <button type="Submit" id="fleet_cert_<?php echo $key['id'] ?>" class="btn btn-primary savebtn">

                <i class="fa fa-floppy-o" aria-hidden="true"></i>&nbsp;&nbsp; Save 

                 </button>

              </div>

           
             </div><!-- /.box-body -->

 


   
 </div>



  </section>
<?php } ?>

<script type="text/javascript">
   $(document).ready(function(){

<?php foreach($vehicleData as $key) { ?>

  
         var fleet_id="<?php echo $key['id'] ?>";
  

        $("#fleet_cert_"+fleet_id).on('click', function () {

           $.ajaxSetup({

          headers: {

              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

          }

         });

            var url = "{{ url('/logistic/fleet-certificate-transaction-form-update') }}";

            var fleetId="<?php echo $key['id'] ?>";
            var renewdt = $("#cert_rnew_dt_"+fleetId).val();


       $.ajax({

           url:url,

           method : "POST",

           type: "JSON",

           data: { fleetId:fleetId,renewdt:renewdt },

           success:function(data){


               var data1 = JSON.parse(data);



              var msg = data1.message;
              var fleetId = data1.id;

                

              if(fleetId == fleetId){
                console.log(msg);

               $("#showmsg_"+fleetId).removeClass('hidemsg');
               
              }
                
           }

        });
       

         /* $.post(url,dataString,function(returndata)
          {
            console.log(returndata);
              $("#moreAddress").show();
              
          });*/

    });

      <?php } ?>

    });


 </script>

   <script type="text/javascript">
  
  $(document).ready(function() {
    
    $('.datepicker').datepicker({
      format: 'yyyy-mm-dd',
      orientation: 'bottom',
      todayHighlight: 'true',
      startDate: 'today'
    });
});

</script>    