
 <div class="row">
       <div class="form-group">
       <div class="col-sm-7">
       <div class="input-group input-group-btn">
           <input name="txt_cli_direccion" id="txt_cli_direccion" type="text" readonly class="form-control"    >
           <button type="button" class="btn btn-inverse" data-toggle="modal" data-target="#myModal">Generar dirección</button>
         </div>
         <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
           <div class="modal-header bg-inverse bd-inverse-darken">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
               <h4 class="modal-title">Crear dirección</h4>
           </div>

           <div class="modal-body">

             <div class="row">
               <div class="col-md-12">
               <div class="form-group">

                  <label class="control-label">Dirección</label>
                  <select id="addr1" class="form-control selectpicker"  parsley-trigger="change">
                       <option value="">- Seleccione -</option>
                       <option value="Autopista">Autopista</option>
                       <option value="Avenida">Avenida</option>
                       <option value="Boulevar">Boulevar</option>
                       <option value="Calle">Calle</option>
                       <option value="Carrera">Carrera</option>
                       <option value="Circular">Circular</option>
                       <option value="Circunvalar">Circunvalar</option>
                       <option value="Diagonal">Diagonal</option>
                       <option value="Transversar">Transversar</option>
                   </select>
                 </div>
             </div>
           </div>
           <div class="row">
             <div class="col-md-4">

               <div class="form-group">
                 <label class="control-label">Digito # 1</label>
                 <input id="addr2" type="number" class="form-control"  parsley-trigger="change">
               </div>
             </div>
             <div class="col-md-4">

               <div class="form-group">
                 <label class="control-label">Letra </label>
                 <select id="addr3" class="form-control selectpicker"  >
                      <option value="">Seleccione</option>
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C">C</option>
                      <option value="D">D</option>
                      <option value="E">E</option>
                      <option value="F">F</option>
                      <option value="G">G</option>
                      <option value="H">H</option>
                      <option value="I">I</option>
                      <option value="J">J</option>
                      <option value="K">K</option>
                      <option value="L">L</option>
                      <option value="M">M</option>
                      <option value="N">N</option>
                      <option value="Ñ">Ñ</option>
                      <option value="O">O</option>
                      <option value="P">P</option>
                      <option value="Q">Q</option>
                      <option value="R">R</option>
                      <option value="S">S</option>
                      <option value="T">T</option>
                      <option value="U">U</option>
                      <option value="V">V</option>
                      <option value="W">W</option>
                      <option value="X">X</option>
                      <option value="Y">Y</option>
                      <option value="Z">Z</option>
                  </select>
               </div>
             </div>
             <div class="col-md-4">

               <div class="form-group">
                 <label class="control-label">Orientación </label>
                 <select id="addr4" class="form-control selectpicker"   >
                      <option value="">Seleccione</option>
                      <option value="Este">Este</option>
                      <option value="Norte">Norte</option>
                      <option value="Occidente">Occidente</option>
                      <option value="Oeste">Oeste</option>
                      <option value="Oriente">Oriente</option>
                      <option value="Sur">Sur</option>
                  </select>
               </div>
             </div>
           </div>
           <div class="row">
             <div class="col-md-4">

               <div class="form-group">
                 <label class="control-label">Digito # 2</label>
                 <input id="addr5" type="number" class="form-control"  parsley-trigger="change" >
               </div>
             </div>
             <div class="col-md-4">

               <div class="form-group">
                 <label class="control-label">Letra </label>
                 <select id="addr6" class="form-control selectpicker"   >
                      <option value="">Seleccione</option>
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="C">C</option>
                      <option value="D">D</option>
                      <option value="E">E</option>
                      <option value="F">F</option>
                      <option value="G">G</option>
                      <option value="H">H</option>
                      <option value="I">I</option>
                      <option value="J">J</option>
                      <option value="K">K</option>
                      <option value="L">L</option>
                      <option value="M">M</option>
                      <option value="N">N</option>
                      <option value="Ñ">Ñ</option>
                      <option value="O">O</option>
                      <option value="P">P</option>
                      <option value="Q">Q</option>
                      <option value="R">R</option>
                      <option value="S">S</option>
                      <option value="T">T</option>
                      <option value="U">U</option>
                      <option value="V">V</option>
                      <option value="W">W</option>
                      <option value="X">X</option>
                      <option value="Y">Y</option>
                      <option value="Z">Z</option>
                  </select>
               </div>
             </div>
             <div class="col-md-4">

               <div class="form-group">
                 <label class="control-label">Orientación </label>
                 <select id="addr7" class="form-control selectpicker"   >
                      <option value="">Seleccione</option>
                      <option value="Este">Este</option>
                      <option value="Norte">Norte</option>
                      <option value="Occidente">Occidente</option>
                      <option value="Oeste">Oeste</option>
                      <option value="Oriente">Oriente</option>
                      <option value="Sur">Sur</option>
                  </select>
               </div>
             </div>
           </div>
           <div class="row">
             <div class="col-md-4">

               <div class="form-group">
                 <label class="control-label">Digito # 3</label>
                 <input id="addr8" type="number" class="form-control"  parsley-trigger="change" >
               </div>
             </div>

           </div>
             <button type="button" class="btn btn-block btn-inverse" id="btnaddress">Agregar direccion</button>
           </div>
         </div>
       </div>


       </div>
   </div>
