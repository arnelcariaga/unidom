
<div id="left-sidebar" class="sidebar">
    <h5 class="brand-name">UNIDOM<a href="javascript:void(0)" class="menu_option float-right"><i class="icon-grid font-16" data-toggle="tooltip" data-placement="left" title="Grid & List Toggle"></i></a></h5>
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu-uni">M&oacute;dulos</a></li>
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu-admin">Admin</a></li>
    </ul>
    <div class="tab-content mt-3">
        <div class="tab-pane fade" id="menu-uni" role="tabpanel">
            <nav class="sidebar-nav">
                <ul class="metismenu">
                    <?php
                    $stmt_select_modules_sidebar = $PDO_conn->query(" exec sp_modules ");
                    $stmt_select_modules_sidebar->execute([]);
                    while ($row_modules_sidebar = $stmt_select_modules_sidebar->fetch(PDO::FETCH_ASSOC)) {
                        if ($row_modules_sidebar['mod_borrado'] != 1) {
                            if ($row_modules_sidebar['mod_admin'] == 1) { ?>
                                <li id="<?php echo sed::encryption($row_modules_sidebar["mod_codigo"]); ?>"><a href="#"><i class="<?php echo $row_modules_sidebar['mod_imagen']; ?>"></i><span><?php echo $row_modules_sidebar['mod_nombre']; ?></span></a></li>
                            <?php }else{
                                // "Aqui van modulos solo para los que no son adminUseOnly";
                            }
                        }else{
                            //echo "Modulo borrado";
                        }
                    }
                    ?> 
                </ul>
            </nav>
        </div>
        <div class="tab-pane fade show active" id="menu-admin" role="tabpanel">
            <nav class="sidebar-nav">
                <ul class="nav metismenu" id="nav-tab" role="tablist">

                    <li class="<?php if(isset($staff_active)){ echo $staff_active; }else{ echo ""; } ?>"><a href="staff.php"><i class="fa fa-user-circle-o"></i><span>Personal</span></a></li>

                    <li class="<?php if(isset($module_active)){ echo $module_active; }else{ echo ""; } ?>"><a href="module.php"><i class="fa fa-archive"></i><span>M&oacute;dulos</span></a></li> 

                    <li class="<?php if(isset($rol_active)){ echo $rol_active; }else{ echo ""; } ?>"><a href="rol.php"><i class="fa fa-cogs"></i><span>Roles</span></a></li>

                    <li class="<?php if(isset($institute_active)){ echo $institute_active; }else{ echo ""; } ?>"><a href="institute.php"><i class="fa fa-building"></i><span>Instituciones</span></a></li>

                    <li class="<?php if(isset($entity_active)){ echo $entity_active; }else{ echo ""; } ?>"><a href="entidad.php"><i class="fa fa-university"></i><span>Entidad</span></a></li>

                    <li class="<?php if(isset($subject_active)){ echo $subject_active; }else{ echo ""; } ?>"><a href="materia.php"><i class="fa fa-book"></i><span>Materia</span></a></li> 

                    <li class="<?php if(isset($career_active)){ echo $career_active; }else{ echo ""; } ?>"><a href="carrera.php"><i class="fa fa-suitcase"></i><span>Carrera</span></a></li> 

                    <li class="<?php if(isset($physical_maintenance_active)){ echo $physical_maintenance_active; }else{ echo ""; } ?>"><a href="planta-fisica.php"><i class="fa fa-wrench"></i><span>Planta f&iacute;sica</span></a></li> 
                </ul>
            </nav>
        </div>
    </div>
</div>