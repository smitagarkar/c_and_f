<aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->

        <section class="sidebar">

          <!-- Sidebar user panel -->

          <div class="user-panel">

            <div class="pull-left image">

              <img src="{{ URL::asset('public/dist/img/admin_img.jpg') }}" class="img-circle" alt="User Image">

            </div>

            <div class="pull-left info">

              <p>{{strtoupper(Session::get('username'))}}</p>

              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

            </div>

          </div>

         

          <!-- sidebar menu: : style can be found in sidebar.less -->

          <ul class="sidebar-menu">

            <li class="header">MAIN NAVIGATION</li>

            <li class="active treeview animated bounceInLeft">

              <a href="{{ url('/dashboard') }}">

                <i class="fa fa-dashboard"></i> 

                <span>Dashboard</span> 

              </a>

            </li>

            <li class="treeview animated bounceInRight">
              <a href="#">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> <span>C and F</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                
           <li class="treeview animated bounceInLeft">

              <a href="#">

                <i class="fa fa-folder" style="color:antiquewhite;"></i>

                 <span>Report/MIS </span>

                <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">

                <li class="animated bounceInLeft">

                  <a href="{{ url('/rept-sap-despatch') }}">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    SAP Vs Dispach Report

                  </a>

                </li>

                <li class="animated bounceInRight">

                  <a href="{{ url( url('/rept-inward-sto-reg') )}}">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Inword  STO Register

                  </a>

                </li>

                <li class="animated bounceInLeft">

                  <a href="{{ url('/outward-dispatch')}}">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Outword Despatch Register

                  </a>

                </li>

                <li class="animated bounceInRight">

                  <a href="{{ url('/rept-sap-list') }}">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Bill Register

                  </a>

                </li>

              </ul>

            </li>

            <li class="treeview animated bounceInRight">

              <a href="#">

                <i class="fa fa-folder" style="color:antiquewhite;"></i>

                 <span>Transaction</span>

                <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">

                <?php 



                $Fname = Session::get('form_name');



                if(isset($Fname)){



                foreach ($Fname as $row) {

                  

                  if('inward transaction' == $row &&  Session::get('usertype')=='superAdmin' || 'inward transaction' == $row && Session::get('usertype')=='user') { 



                ?>

                <li class="animated bounceInLeft">

                    <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Inward Transaction

                    <i class="fa fa-angle-left pull-right"></i>

                    </a>

                     <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-inward-trans') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Inward Trans

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-inward-trans') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Inward Trans

                      </a>

                    </li>

                  </ul>

                </li>


              <?php } else{ } }  }?> 



              <?php if(Session::get('usertype')=='admin'){ ?>

                <li class="animated bounceInLeft">

                    <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Inward Transaction

                    <i class="fa fa-angle-left pull-right"></i>

                    </a>

                     <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-inward-trans') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Inward Trans

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-inward-trans') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Inward Trans

                      </a>

                    </li>

                  </ul>

                </li>



             <?php }else{} ?>



              <?php 



              if(isset($Fname)){



                $Fname = Session::get('form_name');



                foreach ($Fname as $row ) {

                  

                  if('outward transaction' == $row &&  Session::get('usertype')=='superAdmin' || 'outward transaction' == $row && Session::get('usertype')=='user') { 



                ?>



                 <li class="animated bounceInRight">

                    <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                   Outward Transaction

                   <i class="fa fa-angle-left pull-right"></i>

                    </a>

                    <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-outward-trans') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Outward Trans

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-outward-trans') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Outward Trans

                      </a>

                    </li>

                  </ul>

                </li>



               <?php } else{} }  }?> 



               <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class="animated bounceInRight">

                    <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                   Outward Transaction

                   <i class="fa fa-angle-left pull-right"></i>

                    </a>

                    <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-outward-trans') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Outward Trans

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-outward-trans') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Outward Trans

                      </a>

                    </li>

                  </ul>

                </li>



             <?php } else{}?>







                <?php 

                if(isset($Fname)){



                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                  

                  if('sap bill' == $row &&  Session::get('usertype')=='superAdmin' || 'sap bill' == $row && Session::get('usertype')=='user') { 



                ?>



               <li class="animated bounceInLeft">

                    <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                   Bills (Sap/Books)

                   <i class="fa fa-angle-left pull-right"></i>

                    </a>

                    <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-sap-bill') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Bills

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-sap-bill') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Bills

                      </a>

                    </li>

                  </ul>

                </li>

                 <?php } else{} }  }?> 



              <?php if(Session::get('usertype')=='admin'){ ?>

                 <li class="animated bounceInLeft">

                    <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                   Bills (Sap/Books)

                   <i class="fa fa-angle-left pull-right"></i>

                    </a>

                    <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-sap-bill') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Bills

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-sap-bill') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Bills

                      </a>

                    </li>

                  </ul>

                </li>



             <?php } else{}  ?>



 

              </ul>

            </li>



            <li class="treeview animated bounceInLeft">

              <a href="#">

                <i class="fa fa-folder" style="color:antiquewhite;"></i>

                 <span>Master </span>

                <i class="fa fa-angle-left pull-right"></i>

              </a>

              <ul class="treeview-menu">



                <?php 

                if(isset($Fname)){



                $Fname = Session::get('form_name');
                $userId = Session::get('userid');



                foreach ($Fname as $row) {

                  

                  if('master depot' == $row &&  Session::get('usertype')=='superAdmin' || 'master depot' == $row && Session::get('usertype')=='user') { 



                ?>

                <li class="animated bounceInLeft">

                  <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Depot

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-depot') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Depot

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-depot') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Depot

                      </a>

                    </li>

                  </ul>

                </li>

              <?php } else{} } }?>



              <?php if(Session::get('usertype')=='admin'){ ?>



                  <li class="animated bounceInLeft">

                  <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Depot

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-depot') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Depot

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-depot') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Depot

                      </a>

                    </li>

                  </ul>

                </li>



             <?php } else{} ?>



              <?php 

              if(isset($Fname)){

                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                  

                  if('master account' == $row &&  Session::get('usertype')=='superAdmin' || 'master account' == $row && Session::get('usertype')=='user') { 



                ?>

                <li class="animated bounceInRight">

                  <a href="pages/examples/profile.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Account

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>



                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-dealer') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Account

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-dealer') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Account

                      </a>

                    </li>

                  </ul>

                </li>

                <?php } else{} } }?>

                  <?php if(Session::get('usertype')=='admin'){ ?>

                  <li class="animated bounceInRight">

                  <a href="pages/examples/profile.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Account

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>



                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-dealer') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Account

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-dealer') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Account

                      </a>

                    </li>

                  </ul>

                </li>



             <?php } else{} ?>





                 <?php 

                 if(isset($Fname)){

                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                  

                  if('master area' == $row &&  Session::get('usertype')=='superAdmin' || 'master area' == $row && Session::get('usertype')=='user') { 



                ?>



                <li class="animated bounceInLeft">

                  <a href="pages/examples/login.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Area

                     <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-destination') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Area

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-destination') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Area

                      </a>

                    </li>

                  </ul>

                </li>



                <?php } else{} } }?>



               <?php if(Session::get('usertype')=='admin'){ ?>

                   <li class="animated bounceInLeft">

                  <a href="pages/examples/login.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Area

                     <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-destination') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Area

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-destination') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Area

                      </a>

                    </li>

                  </ul>

                </li>



             <?php } else{} ?>




              <?php 

                if(Session::get('usertype')=='admin') { 

              ?>

                <li class="animated bounceInRight">

                  <a href="pages/examples/login.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master User 

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>



                    <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-user') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add User

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-user') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View User

                      </a>

                    </li>

                  </ul>

                </li>

              <?php  } else{} ?>

              <?php 

              if(isset($Fname)){

                $Fname = Session::get('form_name');

                foreach ($Fname as $row) {

                  if('master fy' == $row &&  Session::get('usertype')=='superAdmin' || 'master fy' == $row && Session::get('usertype')=='user') { 

              ?>

                <li class="animated bounceInLeft">

                  <a href="pages/examples/login.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Fy 

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                   <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-fy') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Fy

                      </a>

                    </li>

                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-fy') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Fy

                      </a>

                    </li>

                  </ul>

                </li>

                 <?php } else{} } }?>


             <?php if(Session::get('usertype')=='admin'){ ?>

                   <li class="animated bounceInLeft">

                  <a href="pages/examples/login.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Fy 

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                   <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-fy') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Fy

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-fy') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Fy

                      </a>

                    </li>

                  </ul>



                </li>

             <?php } else{} ?>

              <?php 

               if(isset($Fname)){

                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                  

                  if('master company' == $row &&  Session::get('usertype')=='superAdmin' ||  'master company' == $row && Session::get('usertype')=='user') { 



              ?>



                <li class="animated bounceInRight">

                  <a href="pages/examples/invoice.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Company 

                      <i class="fa fa-angle-left pull-right"></i>

                  </a>



                   <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-company') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Company

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-company') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Company

                      </a>

                    </li>

                  </ul>

                </li>



                 <?php } else{} } }?>



              <?php if(Session::get('usertype')=='admin'){ ?>

                   <li class="animated bounceInRight">

                  <a href="pages/examples/invoice.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Company 

                      <i class="fa fa-angle-left pull-right"></i>

                  </a>



                   <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-company') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Company

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-company') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Company

                      </a>

                    </li>

                  </ul>

                </li>



             <?php } else{} ?>



              <?php 

              if(isset($Fname)){

              $Fname = Session::get('form_name');



              foreach ($Fname as $row) {

                

                if('master um' == $row &&  Session::get('usertype')=='superAdmin' || 'master um' == $row && Session::get('usertype')=='user') { 



              ?>

                <li class="animated bounceInLeft">

                  <a href="pages/examples/profile.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Um 

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>



                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-um') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Um

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-um') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Um

                      </a>

                    </li>

                  </ul>

                </li>



                <?php } else{} } }?>



               <?php if(Session::get('usertype')=='admin'){ ?>



                    <li class="animated bounceInLeft">

                  <a href="pages/examples/profile.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Um 

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>



                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-um') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Um

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-um') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Um

                      </a>

                    </li>

                  </ul>

                </li>



             <?php } else{} ?>



              <?php 

              if(isset($Fname)){

              $Fname = Session::get('form_name');



              foreach ($Fname as $row) {

                

                if('master item um' == $row &&  Session::get('usertype')=='superAdmin' || 'master item um' == $row && Session::get('usertype')=='user') { 



              ?>



                <li class="animated bounceInRight">

                  <a href="pages/examples/login.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Item Um

                    <i class="fa fa-angle-left pull-right"></i> 

                  </a>



                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-itemum') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Item Um

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-itemum') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Item Um

                      </a>

                    </li>

                  </ul>

                </li>

                <?php } else{} } }?>



                 <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class="animated bounceInRight">

                  <a href="pages/examples/login.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Item Um

                    <i class="fa fa-angle-left pull-right"></i> 

                  </a>



                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-itemum') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Item Um

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-itemum') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Item Um

                      </a>

                    </li>

                  </ul>

                </li>



             <?php } else{} ?>



                 <?php 

                 if(isset($Fname)){

              $Fname = Session::get('form_name');



              foreach ($Fname as $row) {

                

                if('master item' == $row &&  Session::get('usertype')=='superAdmin' || 'master item' == $row && Session::get('usertype')=='user') { 



              ?>

                <li class="animated bounceInLeft">

                  <a href="pages/examples/login.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Item 

                     <i class="fa fa-angle-left pull-right"></i>

                  </a>



                   <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-item') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Item

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-item') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Item

                      </a>

                    </li>

                  </ul>

                </li>



                 <?php } else{} } }?>



                <?php if(Session::get('usertype')=='admin'){ ?>



                   <li class="animated bounceInLeft">

                  <a href="pages/examples/login.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Item 

                     <i class="fa fa-angle-left pull-right"></i>

                  </a>



                   <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-item') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Item

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-item') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Item

                      </a>

                    </li>

                  </ul>

                </li>



             <?php } else{} ?>



                <?php 

                if(isset($Fname)){

              $Fname = Session::get('form_name');



              foreach ($Fname as $row) {

                

                if('master account type' == $row &&  Session::get('usertype')=='superAdmin' || 'master account type' == $row && Session::get('usertype')=='user') { 



              ?>

                <li class="animated bounceInRight">

                  <a href="pages/examples/login.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Account Type 

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-account-type') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Account Type

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-account-type') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Account Type

                      </a>

                    </li>

                  </ul>

                </li>

                <?php } else{} } }?>

              <?php if(Session::get('usertype')=='admin'){ ?>



                  <li class="animated bounceInRight">

                  <a href="pages/examples/login.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Account Type 

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-account-type') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Account Type

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-account-type') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Account Type

                      </a>

                    </li>

                  </ul>

                </li>

             <?php } else{} ?>

              </ul>

            </li>

              </ul>
            </li>



            <li class="treeview animated bounceInLeft">
              <a href="#">
                <i class="fa fa-truck" aria-hidden="true"></i> <span>Logistic</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">

                <li class="animated bounceInRight">

                  <a href="#">

                    <i class="fa fa-folder" style="color:antiquewhite;"></i> Transaction

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                 <?php 

		                if(isset($Fname)){

		              $Fname = Session::get('form_name');



		              foreach ($Fname as $row) {

		                

		                if('Fleet transaction' == $row &&  Session::get('usertype')=='superAdmin' || 'Fleet transaction' == $row && Session::get('usertype')=='user') { 



                ?>

                    <li class="animated bounceInLeft">

                      <a href="#"><i class="fa fa-circle-o text-aqua"></i>Fleet Transaction 
                        <i class="fa fa-angle-left pull-right"></i>
                      </a>


                       <ul class="treeview-menu">

                      <li class="animated bounceInLeft">

                        <a href="{{ url('/logistic/fleet-transaction') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Fleet Transaction

                        </a>

                      </li>



                      <li class="animated bounceInRight">

                        <a href="{{ url('/logistic/view-fleet-transaction') }}">

                          <i class="fa fa-circle-o text-red"></i> 

                          View Fleet Transaction

                        </a>

                      </li>

                    </ul>

                    </li>

                  <?php } else{} } }?>


                  <?php if(Session::get('usertype')=='admin'){ ?>

                  	<li class="animated bounceInLeft">

                      <a href="#"><i class="fa fa-circle-o text-aqua"></i>Fleet Transaction 
                        <i class="fa fa-angle-left pull-right"></i>
                      </a>


                       <ul class="treeview-menu">

                      <li class="animated bounceInLeft">

                        <a href="{{ url('/logistic/fleet-transaction') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Fleet Transaction

                        </a>

                      </li>



                      <li class="animated bounceInRight">

                        <a href="{{ url('/logistic/view-fleet-transaction') }}">

                          <i class="fa fa-circle-o text-red"></i> 

                          View Fleet Transaction

                        </a>

                      </li>

                    </ul>

                    </li>

                  <?php }  else{} ?>


                   <?php 

		                if(isset($Fname)){

		              $Fname = Session::get('form_name');



		              foreach ($Fname as $row) {

		                

		                if('Fleet Certificate Trans' == $row &&  Session::get('usertype')=='superAdmin' || 'Fleet Certificate Trans' == $row && Session::get('usertype')=='user') { 



                   ?>
                     <li class="animated bounceInRight">

                      <a href="{{ url('logistic/fleet-certificate-transaction-form') }}"><i class="fa fa-circle-o text-aqua"></i> Fleet Certificate Trans

                      </a>

                    </li>

                    <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

	                    <li class="animated bounceInRight">

	                      <a href="{{ url('logistic/fleet-certificate-transaction-form') }}"><i class="fa fa-circle-o text-aqua"></i> Fleet Certificate Trans

	                      </a>

	                    </li>

                    <?php }  else{} ?>



                   <?php 

		                if(isset($Fname)){

		              $Fname = Session::get('form_name');



		              foreach ($Fname as $row) {

		                

		                if('Fleet Challan Receipt' == $row &&  Session::get('usertype')=='superAdmin' || 'Fleet Challan Receipt' == $row && Session::get('usertype')=='user') { 



                   ?>

                     <li class="animated bounceInRight">

                      <a href="{{ url('/logistic/fleet-challan-receipt') }}"><i class="fa fa-circle-o text-aqua"></i> Fleet Challan Receipt

                      </a>

                    </li>

                    <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

	                    <li class="animated bounceInRight">

	                      <a href="{{ url('/logistic/fleet-challan-receipt') }}"><i class="fa fa-circle-o text-aqua"></i> Fleet Challan Receipt

	                      </a>

	                    </li>

                    <?php }  else{} ?>

                    <?php 

		                if(isset($Fname)){

		              $Fname = Session::get('form_name');



		              foreach ($Fname as $row) {

		                

		                if('TRPT Bill Generate' == $row &&  Session::get('usertype')=='superAdmin' || 'TRPT Bill Generate' == $row && Session::get('usertype')=='user') { 



                   ?>


                    <li class="animated bounceInLeft">

                      <a href="{{ url('/logistic/trpt-bill-generate') }}"><i class="fa fa-circle-o text-aqua"></i>  TRPT Bill Generate

                      </a>

                    </li>

                    <?php } else{} } }?>

                    <?php if(Session::get('usertype')=='admin'){ ?>

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/logistic/trpt-bill-generate') }}"><i class="fa fa-circle-o text-aqua"></i>  TRPT Bill Generate

                      </a>

                    </li>

                    <?php }  else{} ?>

                  </ul>

                </li>

                


               <!--  <li class="animated bounceInRight">

                  <a href="#">

                    <i class="fa fa-folder" style="color:antiquewhite;"></i> Transaction

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="#"><i class="fa fa-circle-o text-aqua"></i>Fleet Transaction 
                        <i class="fa fa-angle-left pull-right"></i>
                      </a>


                       <ul class="treeview-menu">

                      <li class="animated bounceInLeft">

                        <a href="{{ url('/logistic/fleet-transaction') }}">

                          <i class="fa fa-circle-o text-yellow"></i>

                          Add Fleet Transaction

                        </a>

                      </li>



                      <li class="animated bounceInRight">

                        <a href="{{ url('/logistic/view-fleet-transaction') }}">

                          <i class="fa fa-circle-o text-red"></i> 

                          View Fleet Transaction

                        </a>

                      </li>

                    </ul>

                    </li>

                    <li class="animated bounceInRight">

                      <a href="{{ url('logistic/fleet-certificate-transaction-form') }}"><i class="fa fa-circle-o text-aqua"></i> Fleet Certificate Trans

                      </a>

                    </li>


                     <li class="animated bounceInRight">

                      <a href="{{ url('/logistic/fleet-challan-receipt') }}"><i class="fa fa-circle-o text-aqua"></i> Fleet Challan Receipt

                      </a>

                    </li>

                     <li class="animated bounceInLeft">

                      <a href="{{ url('/logistic/trpt-bill-generate') }}"><i class="fa fa-circle-o text-aqua"></i>  TRPT Bill Generate

                      </a>

                    </li>

                  </ul>

                </li> -->

 

                <li class="animated bounceInLeft">

                  <a href="#">

                    <i class="fa fa-folder" style="color:antiquewhite;"></i> Report

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">


                  <?php 

		              if(isset($Fname)){

		              $Fname = Session::get('form_name');

		              foreach ($Fname as $row) {

		                if('Fleet Transaction Report' == $row &&  Session::get('usertype')=='superAdmin' || 'Fleet Transaction Report' == $row && Session::get('usertype')=='user') { 

                   ?>

                    <li class="animated bounceInRight">

                       <a href="{{ url('/logistic/fleet-trans-report') }}"><i class="fa fa-circle-o text-aqua"></i> Fleet Transaction Report

                      </a>

                    </li>
                <?php } else{} } }?>

                <?php if(Session::get('usertype')=='admin'){ ?>

                	<li class="animated bounceInRight">

                       <a href="{{ url('/logistic/fleet-trans-report') }}"><i class="fa fa-circle-o text-aqua"></i> Fleet Transaction Report

                      </a>

                    </li>

                <?php }  else{} ?>

                <?php 

		              if(isset($Fname)){

		              $Fname = Session::get('form_name');

		              foreach ($Fname as $row) {

		                if('Fleet Certificate Report' == $row &&  Session::get('usertype')=='superAdmin' || 'Fleet Certificate Report' == $row && Session::get('usertype')=='user') { 

                   ?>

                    <li class="animated bounceInRight">

                       <a href="{{ url('/logistic/fleet-certificate-report') }}"><i class="fa fa-circle-o text-aqua"></i> Fleet Certificate Report

                      </a>

                    </li>

                   <?php } else{} } }?>

                  <?php if(Session::get('usertype')=='admin'){ ?>

                  	<li class="animated bounceInRight">

                       <a href="{{ url('/logistic/fleet-certificate-report') }}"><i class="fa fa-circle-o text-aqua"></i> Fleet Certificate Report

                      </a>

                    </li>

                  <?php }  else{} ?>

                  <?php 

		              if(isset($Fname)){

		              $Fname = Session::get('form_name');

		              foreach ($Fname as $row) {

		                if('TRPT Bill Report' == $row &&  Session::get('usertype')=='superAdmin' || 'TRPT Bill Report' == $row && Session::get('usertype')=='user') { 

                   ?>

                    <li class="animated bounceInLeft">

                       <a href="{{ url('/logistic/trpt-payment-advice') }}"><i class="fa fa-circle-o text-aqua"></i> TRPT Bill Report

                      </a>

                    </li>

                  <?php } else{} } }?>

                  <?php if(Session::get('usertype')=='admin'){ ?>

                  	<li class="animated bounceInLeft">

                       <a href="{{ url('/logistic/trpt-payment-advice') }}"><i class="fa fa-circle-o text-aqua"></i> TRPT Bill Report

                      </a>

                    </li>

                  <?php }  else{} ?>

                  </ul>

                </li>

                 
<!-- 
                <li class="animated bounceInLeft">

                  <a href="#">

                    <i class="fa fa-folder" style="color:antiquewhite;"></i> Report

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                    


                    <li class="animated bounceInLeft">

                       <a href="{{ url('/logistic/trpt-payment-advice') }}"><i class="fa fa-circle-o text-aqua"></i> TRPT Bill Report

                      </a>

                    </li>

                    <li class="animated bounceInRight">

                       <a href="{{ url('/logistic/fleet-trans-report') }}"><i class="fa fa-circle-o text-aqua"></i> Fleet Transaction Report

                      </a>

                    </li>



                  </ul>

                </li> -->


                 


                <li class="animated bounceInRight">

                  <a href="#">

                    <i class="fa fa-folder" style="color:antiquewhite;"></i> Master

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                    <ul class="treeview-menu">

                       <?php 

              if(isset($Fname)){

                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                  

                  if('master fleet' == $row &&  Session::get('usertype')=='superAdmin' || 'master fleet' == $row && Session::get('usertype')=='user') { 



              ?>

                <li class="animated bounceInLeft">

                  <a href="pages/examples/invoice.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Fleet

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>



                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-fleet') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Fleet

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-fleet') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Fleet

                      </a>

                    </li>

                  </ul>

                </li>



                <?php } else{} } }?>



              <?php if(Session::get('usertype')=='admin'){ ?>



                  <li class="animated bounceInLeft">

                  <a href="pages/examples/invoice.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Fleet

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>



                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-fleet') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Fleet

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-fleet') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Fleet

                      </a>

                    </li>

                  </ul>

                </li>

             <?php } else{} ?>

                <?php 

              if(isset($Fname)){

                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                  

                  if('fleet truck wheel' == $row &&  Session::get('usertype')=='superAdmin' || 'fleet truck wheel' == $row && Session::get('usertype')=='user') { 



              ?>

                <li class="animated bounceInRight">

                  <a href="pages/examples/invoice.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Fleet Truck Wh

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>



                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-fleet-truck-wheel') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Fleet Truck Wheel

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-flet-truck-wheel') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Fleet Truck Wheel

                      </a>

                    </li>

                  </ul>

                </li>



                <?php } else{} } }?>



              <?php if(Session::get('usertype')=='admin'){ ?>



                  <li class="animated bounceInRight">

                  <a href="pages/examples/invoice.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Fleet Truck Wh

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>



                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-fleet-truck-wheel') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Fleet Truck Wheel

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-flet-truck-wheel') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Fleet Truck Wheel

                      </a>

                    </li>

                  </ul>

                </li>

             <?php } else{} ?>

                 <?php 

              if(isset($Fname)){

                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                  

                  if('Master Vehicle Manufactur' == $row &&  Session::get('usertype')=='superAdmin' || 'Master Vehicle Manufactur' == $row && Session::get('usertype')=='user') { 



              ?>

                <li class="animated bounceInLeft">

                  <a href="pages/examples/invoice.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Vehicle Mfg

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>



                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-manufacturing') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Vehicle Manufactur

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-manufature') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Vehicle Manufacturing

                      </a>

                    </li>

                  </ul>

                </li>



                <?php } else{} } }?>



              <?php if(Session::get('usertype')=='admin'){ ?>



                  <li class="animated bounceInLeft">

                  <a href="pages/examples/invoice.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Vehicle Mfg

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>



                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-manufacturing') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Vehicle Manufactur

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-manufature') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Vehicle Manufactur

                      </a>

                    </li>

                  </ul>

                </li>

             <?php } else{} ?>

                <?php 

              if(isset($Fname)){

                $Fname = Session::get('form_name');



                foreach ($Fname as $row) {

                  

                  if('master rate' == $row &&  Session::get('usertype')=='superAdmin' || 'master rate' == $row && Session::get('usertype')=='user') { 



              ?>



                <li class="animated bounceInRight">

                  <a href="pages/examples/profile.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Rate

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-rate') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Rate

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-rate') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Rate

                      </a>

                    </li>

                  </ul>



                </li>



                <?php } else{} } }?>



            <?php if(Session::get('usertype')=='admin'){ ?>



                  <li class="animated bounceInRight">

                  <a href="pages/examples/profile.html">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Master Rate

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="{{ url('/form-mast-rate') }}">

                        <i class="fa fa-circle-o text-yellow"></i>

                        Add Rate

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="{{ url('/view-mast-rate') }}">

                        <i class="fa fa-circle-o text-red"></i> 

                        View Rate

                      </a>

                    </li>

                  </ul>



                </li>



             <?php } else{} ?>




                </ul>
              </li>

            </ul>
          </li>


        <li class="treeview animated bounceInLeft">
           <a href="#">
        <i class="fa fa-list" aria-hidden="true"></i> <span>Finance</span>
        <i class="fa fa-angle-left pull-right"></i>
      </a>
      <ul class="treeview-menu">

                <li class="animated bounceInLeft">

                  <a href="#">

                    <i class="fa fa-folder" style="color:antiquewhite;"></i> Transaction

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
            <ul class="treeview-menu">


<?php if(Session::get('usertype')=='admin'){ ?>

               

                 <li class="animated bounceInRight">

                    <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Receipt Cash/Bank

                    </a>

                </li>

                <li class="animated bounceInLeft">

                    <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                    Payment Cash/Bank

                    </a>

                </li>

                <li class="animated bounceInRight">

                    <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                   Journal

                    </a>

                </li>

                <li class="animated bounceInLeft">

                    <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                   Purchase

                    </a>

                </li>

                <li class="animated bounceInRight">

                    <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                   Sales

                    </a>

                </li>

                <li class="animated bounceInLeft">

                    <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                   Debit Note

                    </a>

                </li>

                <li class="animated bounceInRight">

                    <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i> 

                   Credit Note

                    </a>

                </li>



                 <li class="animated bounceInLeft">

                  <a href="#">

                    <i class="fa fa-circle-o text-aqua"></i>Non Accounting

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>

                  <ul class="treeview-menu">

                    <li class="animated bounceInLeft">

                      <a href="#"><i class="fa fa-circle-o text-aqua"></i>Purchase Order

                      </a>

                    </li>



                    <li class="animated bounceInRight">

                      <a href="#"><i class="fa fa-circle-o text-aqua"></i> Sale Order

                      </a>

                    </li>

                     <li class="animated bounceInLeft">

                      <a href="#"><i class="fa fa-circle-o text-aqua"></i> Good Receipt Note

                      </a>

                    </li>

                     <li class="animated bounceInRight">

                      <a href="#"><i class="fa fa-circle-o text-aqua"></i>  Dispatch/Delivery Note

                      </a>

                    </li>

                    <li class="animated bounceInLeft">

                      <a href="#"><i class="fa fa-circle-o text-aqua"></i> GRN Bills

                      </a>

                    </li>

                    <li class="animated bounceInRight">

                      <a href="#"><i class="fa fa-circle-o text-aqua"></i> Delivery Bills

                      </a>

                    </li>

                    <li class="animated bounceInLeft">

                      <a href="#"><i class="fa fa-circle-o text-aqua"></i> Qty only

                      </a>

                    </li>



                  </ul>

                </li>

              <?php } else{} ?>

 	</ul>

      </li>


       <li class="animated bounceInRight">

                  <a href="#">

                    <i class="fa fa-folder" style="color:antiquewhite;"></i> Master

                    <i class="fa fa-angle-left pull-right"></i>

                  </a>
			            <ul class="treeview-menu">
			            	<li class="animated bounceInRight">

		                      <a href="#"><i class="fa fa-circle-o text-aqua"></i> Profit Center Master
                             <i class="fa fa-angle-left pull-right"></i>
		                      </a>

                           <ul class="treeview-menu">

                            <li class="animated bounceInLeft">

                              <a href="{{ url('/finance/profit-center-mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Profit Center

                              </a>

                            </li>



                            <li class="animated bounceInRight">

                                  <a href="{{ url('/finance/view-mast-profit-center') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                  View Profit Center

                                  </a>

                            </li>

                          </ul>

                      </li>


                          <li class="animated bounceInLeft">

                              <a href="#">

                              <i class="fa fa-circle-o text-aqua"></i> 

                              Tax Master

                              <i class="fa fa-angle-left pull-right"></i>

                              </a>

                               <ul class="treeview-menu">

                              <li class="animated bounceInLeft">

                                <a href="{{ url('/finance/tax') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Tax Master

                                </a>

                              </li>



                              <li class="animated bounceInRight">

                                <a href="{{ url('/finance/view-tax') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View Tax Master

                                </a>

                              </li>

                            </ul>

                          </li>

                          <li class="animated bounceInRight">

                              <a href="#">

                              <i class="fa fa-circle-o text-aqua"></i> 

                              GLSCH Master

                              <i class="fa fa-angle-left pull-right"></i>

                              </a>

                               <ul class="treeview-menu">

                              <li class="animated bounceInLeft">

                                <a href="{{ url('/finance/glsch') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add GLSCH Master

                                </a>

                              </li>



                              <li class="animated bounceInRight">

                                <a href="{{ url('/finance/view-glsch') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View GLSCH Master

                                </a>

                              </li>

                            </ul>

                          </li>


                          <li class="animated bounceInLeft">

                              <a href="#">

                              <i class="fa fa-circle-o text-aqua"></i> 

                              GL Master

                              <i class="fa fa-angle-left pull-right"></i>

                              </a>

                               <ul class="treeview-menu">

                              <li class="animated bounceInLeft">

                                <a href="{{ url('/finance/gl-mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add GL Master

                                </a>

                              </li>



                              <li class="animated bounceInRight">

                                <a href="{{ url('/finance/view-gl-mast') }}">

                                  <i class="fa fa-circle-o text-red"></i> 

                                  View GL Master

                                </a>

                              </li>

                            </ul>

                          </li>

                          <li class="animated bounceInRight">

                          <a href="#">
                            <i class="fa fa-circle-o text-aqua"></i> Config Master
                              <i class="fa fa-angle-left pull-right"></i>
                             <ul class="treeview-menu">

                            <li class="animated bounceInLeft">

                              <a href="{{ url('/finance/config-mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Config

                              </a>

                            </li>



                            <li class="animated bounceInRight">

                                  <a href="{{ url('/finance/view-config-mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                  View Config

                                  </a>

                            </li>

                          </ul>
                          </a>

                        </li>
                         <li class="animated bounceInLeft">

                          <a href="#"><i class="fa fa-circle-o text-aqua"></i>Tran Tax Master
                            <i class="fa fa-angle-left pull-right"></i>
                             <ul class="treeview-menu">

                              <li class="animated bounceInLeft">

                                <a href="{{ url('/finance/tran-tax-mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Tran Tax

                                </a>

                              </li>



                              <li class="animated bounceInRight">

                                    <a href="{{ url('/finance/view-tran-tax-mast') }}">

                                      <i class="fa fa-circle-o text-red"></i> 

                                    View Tran Tax

                                    </a>

                              </li>

                          </ul>
                          </a>

                            </li>

                           <li class="animated bounceInRight">

                          <a href="#">
                            <i class="fa fa-circle-o text-aqua"></i> Department Master
                              <i class="fa fa-angle-left pull-right"></i>
                             <ul class="treeview-menu">

                            <li class="animated bounceInLeft">

                              <a href="{{ url('/finance/department-mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Department

                              </a>

                            </li>



                            <li class="animated bounceInRight">

                                  <a href="{{ url('/finance/view-department-mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                  View Department

                                  </a>

                            </li>

                          </ul>
                          </a>

                        </li>

                        <li class="animated bounceInLeft">

                          <a href="#"><i class="fa fa-circle-o text-aqua"></i> Transaction Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class="animated bounceInLeft">

                              <a href="{{ url('/finance/form-transaction-mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Transaction

                              </a>

                            </li>



                            <li class="animated bounceInRight">

                                  <a href="{{ url('/finance/view-mast-transaction') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Transaction

                                  </a>

                            </li>

                          </ul>

                        </li>

                        <li class="animated bounceInRight">

                          <a href="#"><i class="fa fa-circle-o text-aqua"></i> Gl Key Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class="animated bounceInLeft">

                              <a href="{{ url('/finance/gl-key-mast') }}">

                                <i class="fa fa-circle-o text-yellow"></i>

                                Add Gl Key

                              </a>

                            </li>



                            <li class="animated bounceInRight">

                                  <a href="{{ url('/finance/view-gl-key-mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Gl Key

                                  </a>

                            </li>

                          </ul>

                        </li>

                        <li class="animated bounceInLeft">

                          <a href="#"><i class="fa fa-circle-o text-aqua"></i>  Item Class Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class="animated bounceInLeft">

                                <a href="{{ url('/finance/form-mast-item-class') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Class

                                </a>

                            </li>



                            <li class="animated bounceInRight">

                                  <a href="{{ url('/finance/view-mast-item-class') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Class

                                  </a>

                            </li>

                          </ul>

                        </li>
                        <li class="animated bounceInRight">

                          <a href="#"><i class="fa fa-circle-o text-aqua"></i>  Item Type Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class="animated bounceInLeft">

                                <a href="{{ url('/finance/form-mast-item-type') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Type

                                </a>

                            </li>



                            <li class="animated bounceInRight">

                                  <a href="{{ url('/finance/view-mast-item-type') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Type

                                  </a>

                            </li>

                          </ul>

                        </li>

                         <li class="animated bounceInLeft">

                          <a href="#"><i class="fa fa-circle-o text-aqua"></i> Valuation Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class="animated bounceInLeft">

                                <a href="{{ url('/finance/form-mast-valuation') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Valuation

                                </a>

                            </li>



                            <li class="animated bounceInRight">

                                  <a href="{{ url('/finance/view-mast-valuation') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Valuation

                                  </a>

                            </li>

                          </ul>

                        </li>

                        <li class="animated bounceInRight">

                          <a href="#"><i class="fa fa-circle-o text-aqua"></i> Plant Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class="animated bounceInLeft">

                                <a href="{{ url('/finance/form-plant-mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Plant

                                </a>

                            </li>



                            <li class="animated bounceInRight">

                                  <a href="{{ url('/finance/view-mast-plant') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Plant

                                  </a>

                            </li>

                          </ul>

                        </li>

                        <li class="animated bounceInLeft">

                          <a href="#"><i class="fa fa-circle-o text-aqua"></i>  Rack Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class="animated bounceInLeft">

                                <a href="{{ url('/finance/form-mast-rack') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Rack 

                                </a>

                            </li>



                            <li class="animated bounceInRight">

                                  <a href="{{ url('/finance/view-mast-rack') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Rack 

                                  </a>

                            </li>

                          </ul>

                        </li>


                        <li class="animated bounceInRight">

                          <a href="#"><i class="fa fa-circle-o text-aqua"></i> Item Rack Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class="animated bounceInLeft">

                                <a href="{{ url('/finance/form-mast-item-rack') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Rack 

                                </a>

                            </li>



                            <li class="animated bounceInRight">

                                  <a href="{{ url('/finance/view-mast-item-rack') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Rack 

                                  </a>

                            </li>

                          </ul>

                        </li>

                        <li class="animated bounceInLeft">

                          <a href="#"><i class="fa fa-circle-o text-aqua"></i> Item Category Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class="animated bounceInLeft">

                                <a href="{{ url('/finance/item-category') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Category

                                </a>

                            </li>



                            <li class="animated bounceInRight">

                                  <a href="{{ url('/finance/view-item-category') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Category

                                  </a>

                            </li>

                          </ul>

                        </li>

                        <li class="animated bounceInRight">

                          <a href="#"><i class="fa fa-circle-o text-aqua"></i> Item Group Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class="animated bounceInLeft">

                                <a href="{{ url('/finance/item-group') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Item Group

                                </a>

                            </li>



                            <li class="animated bounceInRight">

                                  <a href="{{ url('/finance/view-item-group') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Item Group

                                  </a>

                            </li>

                          </ul>

                        </li>

                        <li class="animated bounceInLeft">

                          <a href="#"><i class="fa fa-circle-o text-aqua"></i> TDS Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class="animated bounceInLeft">

                                <a href="{{ url('/finance/tds-mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add TDS

                                </a>

                            </li>



                            <li class="animated bounceInRight">

                                  <a href="{{ url('/finance/view-tds-mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View TDS

                                  </a>

                            </li>

                          </ul>

                        </li>


                        <li class="animated bounceInRight">

                          <a href="#"><i class="fa fa-circle-o text-aqua"></i> Acc Class Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class="animated bounceInLeft">

                                <a href="{{ url('/finance/form-mast-acc-class') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add Acc Class 

                                </a>

                            </li>



                            <li class="animated bounceInRight">

                                  <a href="{{ url('/finance/view-mast-acc-class') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View Acc Class

                                  </a>

                            </li>

                          </ul>

                        </li>

                        <li class="animated bounceInLeft">

                          <a href="#"><i class="fa fa-circle-o text-aqua"></i> TDS Rate Master
                            <i class="fa fa-angle-left pull-right"></i>
                          </a>

                          <ul class="treeview-menu">

                            <li class="animated bounceInLeft">

                                <a href="{{ url('/finance/tds-rate-mast') }}">

                                  <i class="fa fa-circle-o text-yellow"></i>

                                  Add TDS Rate

                                </a>

                            </li>
                            
                            <li class="animated bounceInRight">

                                  <a href="{{ url('/finance/view-tds-rate-mast') }}">

                                    <i class="fa fa-circle-o text-red"></i> 

                                    View TDS Rate

                                  </a>

                            </li>

                          </ul>

                        </li>

		</ul>	            

 </li>


</ul>



            <?php 

 

                  if(Session::get('usertype')=='admin') { 



              ?>

            <li class="active treeview animated bounceInRight">

              <a href="{{ url('/dashboard') }}">

                <i class="fa fa-cogs" aria-hidden="true"></i>

                <span>Setting</span> 

              </a>

            </li>

          <?php } else{ } ?>

          </ul>

        </section>

        <!-- /.sidebar -->

      </aside>