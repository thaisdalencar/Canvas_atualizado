<!DOCTYPE html>
<html>
    <head>
        <?php include_once('./application/views/head.php'); ?>
    </head>
    <body>
     <div class="container">
            <?php include_once('./application/views/menu.php'); ?>  
        <div >
        <div class="container-fluid">            
            <div class="row">
                <div class="col-md-12">                              
                    <div class="dados"><h3>Nome: <?php echo $projeto->getNome(); ?></h3></div>    
                    <div class="dados"><h3>GP: <?php echo $projeto->getGp(); ?></h3></div>  
                </div>
            </div>  
        </div> 
            <div class="container-fluid">            
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="pmc-slot">
                                    <img src="<?php echo base_url();?>static/imgs/canvas/justificativas.png">
                                    <textarea id="txtJustificativas" name="justificativas" class="textareaAmarelo"><?php echo $canvas->getJustificativas();?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="pmc-slot">
                                    <img src="<?php echo base_url();?>static/imgs/canvas/produto.png">
                                    <textarea id="txtProduto" name="produto" class="textareaRoxo"><?php echo $canvas->getProduto();?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="pmc-slot">
                                    <img src="<?php echo base_url();?>static/imgs/canvas/steak.png">
                                    <textarea id="txtStakeholders" name="stake"><?php echo $canvas->getStakeholders();?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="pmc-slot">
                                    <img src="<?php echo base_url();?>static/imgs/canvas/premissas.png">
                                    <textarea id="txtPremissas" name="premissas" class="textareaAzul"><?php echo $canvas->getPremissas();?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="pmc-slot">
                                    <img src="<?php echo base_url();?>static/imgs/canvas/riscos.png">
                                    <textarea id="txtRiscos" name="riscos" class="textareaVerde"><?php echo $canvas->getRiscos();?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="pmc-slot">
                                            <img src="<?php echo base_url();?>static/imgs/canvas/obj.png">
                                    <textarea id="textObjetivo" name="objetivo" class="textareaAmarelo"><?php echo $canvas->getObjsmart();?></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="pmc-slot">
                                            <img src="<?php echo base_url();?>static/imgs/canvas/beneficios.png">
                                    <textarea id="textareaBeneficios" name="beneficios" class="textareaAmarelo"><?php echo $canvas->getBeneficios();?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="pmc-slot">
                                    <img src="<?php echo base_url();?>static/imgs/canvas/requisitos.png">
                                    <textarea id="txtRequisitos" name="requisitos" class="textareaRoxo" ><?php echo $canvas->getRequisitos();?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="pmc-slot">
                                    <img src="<?php echo base_url();?>static/imgs/canvas/equipe.png">
                                    <textarea id="txtEquipe" name="equipe" ><?php echo $canvas->getEquipe();?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="pmc-slot">
                                    <img src="<?php echo base_url();?>static/imgs/canvas/entregas.png">
                                    <textarea id="txtEntregas" name="entregas" class="textareaAzul"><?php echo $canvas->getGrupoDeEntregas();?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="pmc-slot">
                                    <img src="<?php echo base_url();?>static/imgs/canvas/linhadotempo.png">
                                    <textarea id="txtTempo" name="tempo" class="textareaVerde"><?php echo $canvas->getLinhaDoTempo();?></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="pmc-slot">
                                    <img src="<?php echo base_url();?>static/imgs/canvas/restricoes.png">
                                    <textarea id="txtRestricoes" name="restricoes" class="textareaAzul" ><?php echo $canvas->getRestricoes();?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="pmc-slot">
                                    <img src="<?php echo base_url();?>static/imgs/canvas/custos.png">
                                    <textarea id="txtCustos" name="custos" class="textareaVerde"><?php echo $canvas->getCustos();?></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>   
            <input id="id_canvas" type="hidden" value="<?php echo $canvas->getId_canvas(); ?>">
            <input id="id_projeto" type="hidden" value="<?php echo $canvas->getId_projeto(); ?>">

            <div id="alertSave"></div>
            <button id="btnBack" class="btn btn-lg btn-success" type="button">Voltar</button>
            <button id="btnSave" class="btn btn-lg btn-primary" type="button">Salvar</button>
        </div>

        <div class="modal fade" id="Modal_back" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                    <h4 class="modal-title" id="myModalLabel">Confirmar volta</h4>
                    </div>
                    <div class="modal-body">
                        <h3>Alterações não salvas serão perdidas.</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button id="btnBackOk" type="button" class="btn btn-primary">Voltar</button>
                    </div>
                </div>
            </div>
        </div>
      </div>  
    </body>
</html>
