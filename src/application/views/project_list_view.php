<!DOCTYPE html>
<html>
    <head>
        <?php include_once('./application/views/head.php'); ?>

        <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
        <script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>
        <link rel="stylesheet" href="/resources/demos/style.css"> -->


    </head>
    <body>
        <div class="container">
            <?php include_once('./application/views/menu.php'); ?>
            <div id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title">Editar Projeto</h4>
                        </div>
                        <div class="modal-body">
                            <form id="projectEditForm" class="form-horizontal">
                                <div class="form-group">
                                    <label for="projectModalNameInput" class="col-sm-2 control-label">Nome</label>
                                    <div class="col-sm-10">
                                        <input id="projectModalNameInput" name="projectName" type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="gpModalInput" class="col-sm-2 control-label">Gerente</label>
                                    <div class="col-sm-10">
                                        <input id="gpModalInput" name="gp" type="text" class="form-control" placeholder="">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="finalModalDateInput" class="col-sm-2 control-label">Final</label>
                                    <div class="col-sm-10">
                                        <input id="finalModalDateInput" name="finalDate" type="text" class="form-control" placeholder="dd/mm/yyyy" onkeypress="mascara(this, data_mask)" maxlength="10">
                                    </div>
                                </div>
                            </form>
                            <div id="projectUpdateStatus">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button id="btnProjectEdit" type="button" class="btn btn-primary">Save changes</button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-body">
                    <form id="projectCreationForm" class="form-inline">
                        <div class="form-group">
                            <label for="projectNameInput">Nome</label>
                            <input id="projectNameInput" name="projectName" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="gpInput">Gerente</label>
                            <input id="gpInput" name="gp" type="text" class="form-control" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="finalDateInput">Data Final</label>
                            <input id="finalDateInput" name="finalDate" type="text" class="form-control" placeholder="dd/mm/yyyy" onkeypress="mascara(this, data_mask)" maxlength="10">
                        </div>
                        <button id="btnCreate" class="btn btn-primary" type="button">Criar projeto</button>
                    </form>
                </div>
            </div>
            
            
            <div id="projectCreationStatus">
            </div>
            
            
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-striped centralizaTudo">
                            <tbody id="projectsTable">
                                <tr>
                                    <th>ID</th>
                                    <th>Nome</th>
                                    <th>GP</th>
                                    <th>Data de Início</th>
                                    <th>Data Final</th>
                                    <th>Deadline</th>
                                    <th>Ações</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
