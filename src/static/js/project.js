var txtProjectName;
var txtGp;
var txtFinalDate;
var btnProjectCreate;
var projectCreationStatus;
var projectList;

//Model Elements
var myModal;
var txtModalName;
var txtModalGp;
var txtModalFinalDate;
var btnProjectEdit;
var projectUpdateStatus;

function clearFields(){
    txtProjectName.val("");
    txtGp.val("");
    txtFinalDate.val("");
}

// função para implementar as barras do campo data
function mascara(o,f){
    v_obj=o
    v_fun=f
    setTimeout("execmascara()",1)
}

// Função para executar a máscara do campo data
function execmascara(){
    v_obj.value=v_fun(v_obj.value)
}

function data_mask(v){
    v=v.replace(/\D/g,"") ;                //Remove tudo o que não é dígito
    v=v.replace(/(\d{2})(\d)/,"$1/$2");    //Coloca ponto entre o terceiro e o quarto dígitos
    v=v.replace(/(\d{2})(\d)/,"$1/$2");    //Coloca ponto entre o setimo e o oitava dígitos
    return v;
}
    
function drawProjectsList(container, projects){
    $('.project-row').remove();
    var row;
    for(var i = 0 ; i < projects.length ; i++){
        row = $('<tr class="project-row">');
        
        var col1 = $('<td>');
        col1.append(projects[i].id);
        row.append(col1);
        
        var col2 = $('<td>');
        col2.append(projects[i].nome);
        row.append(col2);
        
        var col3 = $('<td>');
        col3.append(projects[i].gp);
        row.append(col3);
        
        var col4 = $('<td>');
        col4.append(projects[i].inicio);
        row.append(col4);
        
        var col5 = $('<td>');
        col5.append(projects[i].fim);
        row.append(col5);
        
        var col6 = $('<td>');
        col6.append(projects[i].deadLineStatus);
        row.append(col6);
        
        var col7 = $('<td>');
        
        var spanSee = $('<span>', {class: 'glyphicon glyphicon-eye-open'});
        var buttonSee = $('<button>' ,{type:"button", class: "btn btn-default btn-xs", diretion: "", title: "Visualizar"});
        buttonSee.click(
            {project: projects[i]},
            function(event){
                var project = event.data.project;
                console.log(event.data.project);
                window.open("projects/loadProjectCanvas/"+project.id, "_self");
            }
        );
        buttonSee.append(spanSee);
        
        var spanEdit = $('<span>', {class: 'glyphicon glyphicon-edit'});
        var buttonEdit = $('<button>' ,{type:"button", class: "btn btn-default btn-xs", diretion: "", title: "Editar", "data-toggle": "popover", "data-html": "true"});
        buttonEdit.append(spanEdit);
        
        buttonEdit.click(
            {project: projects[i], containerLvl2: container},
            function(event){
                var proj = event.data.project
                var containerLvl3 = event.data.containerLvl2;
                
                txtModalName.val(proj.nome);
                txtModalGp.val(proj.gp);
                txtModalFinalDate.val(proj.fim);
                
                btnProjectEdit.off("click");
                btnProjectEdit.click(
                    {project: proj, containerLvl3: event.data.containerLvl2},
                    function(event){
                        var proj = event.data.project
                        var containerLvl4 = event.data.containerLvl3;
                        $.ajax({
                            type: "POST",
                            url: "projects/update",
                            data: {
                                id: proj.id,
                                projectName: txtModalName.val(),
                                gp: txtModalGp.val(),
                                finalDate: txtModalFinalDate.val()
                            },
                            success: function (data){
                                if(data.status){
                                    myModal.modal('hide');
                                    projectUpdateStatus.empty();
                                    projectCreationStatus.empty();
                                    var sucessDiv = $("<div>", {class: "alert alert-success alert-dismissible", role: "alert"});
                                    sucessDiv.append($("<p>", {text: "Projeto Editado com sucesso"}));
                                    projectCreationStatus.append(sucessDiv);
                                    $.ajax({
                                        type: "GET",
                                        url: "projects/getProjectsAsJSON",
                                        success: function (data){
                                            drawProjectsList(containerLvl4, data);
                                        },
                                        dataType: "json"
                                    });
                                    window.setTimeout(function(){
                                        sucessDiv.toggle("slow", function() {
                                            projectCreationStatus.empty();
                                        });
                                    }, 3000);
                                }
                                else{
                                    projectUpdateStatus.empty();
                                    projectCreationStatus.empty();
                                    var errorDiv = $("<div>", {class: "alert alert-danger alert-dismissible", role: "alert"});
                                    errorDiv.append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
                                    var errorList = $("<ul>");
                                    for(var i = 0 ; i < data.errors.length; i++){
                                        errorList.append(data.errors[i]);
                                    }
                                    errorDiv.append(errorList);
                                    projectUpdateStatus.append(errorDiv);
                                }
                            },
                            dataType: "json"
                        });                       
                        
                    }
                );
                myModal.modal('show');
            }
        );
        
        var spanRemove = $('<span>', {class: 'glyphicon glyphicon-remove'});
        var buttonRemove = $('<button>' ,{type:"button", class: "btn btn-default btn-xs", diretion: "", "title": "Excluir", "data-toggle": "popover", "data-html": "true"});
        buttonRemove.append(spanRemove);
        
        
        var link = "projects";
        
		var div = $("<div>", {class: "btn-group"}); // create a new 'div' jQuery HTML Object 
		//var anchor = $("<a>", {href: link, text: "Sim"}); // create a new 'a' jQuery HTML Object 
		var sim = $("<button>", {type: "button", text: "Sim", class: "btn btn-default link"}); // create a new 'button' jQuery HTML Object
        
        sim.click(
            {project: projects[i], containerLvl2: container},
            function(event){ //set the 'onclick' method of the 'not' button to toggle the respective popover
                var projectId = event.data.project.id;
                var containerLvl3 = event.data.containerLvl2;
                $.ajax({
                    type: "POST",
                    url: "projects/delete",
                    data: {id: projectId},
                    success: function (data){
                        if(data.status){
                            console.log("deleteado");
                            //===============
                            projectUpdateStatus.empty();
                            projectCreationStatus.empty();
                            var sucessDiv = $("<div>", {class: "alert alert-success alert-dismissible", role: "alert"});
                            sucessDiv.append($("<p>", {text: "Projeto Excluido com sucesso"}));
                            projectCreationStatus.append(sucessDiv);
                            //==================
                            $.ajax({
                                type: "GET",
                                url: "projects/getProjectsAsJSON",
                                success: function (data){
                                    drawProjectsList(containerLvl3, data);
                                },
                                dataType: "json"
                            });
                            //===========
                              window.setTimeout(function(){
                                        sucessDiv.toggle("slow", function() {
                                            projectCreationStatus.empty();
                                        });
                                    }, 3000);
                            //=============
                        }
                        else{
                            console.log("deu merda");
                        }
                    },
                    dataType: "json"
                });
            }
        );
        
		//sim.append(anchor); // append the 'a' to the yes button
		var nao = $("<button>", {type: "button", class: "btn btn-default", text: "Não"}); // create a new 'button' jQuery HTML Object
		nao.click(
            {popoverButtonRemove: buttonRemove},
            function(event){ //set the 'onclick' method of the 'not' button to toggle the respective popover
                event.data.popoverButtonRemove.popover('toggle');
            }
        );
		div.append(sim); // append the 'yes' button to the 'div'
		div.append(nao); // append the 'not' button to the 'div'
		buttonRemove.popover({ // create the popover on the respective button
			animation: true,
			content: div,
			html: true
		});	
        
        buttonRemove.attr('title', buttonRemove.attr('data-original-title'));
        
        col7.append(buttonSee);
        col7.append(buttonEdit);
        col7.append(buttonRemove);
        
        row.append(col7);
        container.append(row);
    }
}


$(document).ready(function(){
    projectList = $("#projectsTable");
    $.ajax({
        type: "GET",
        url: "projects/getProjectsAsJSON",
        success: function (data){
            drawProjectsList(projectList, data);
        },
        dataType: "json"
    });
    
    txtProjectName = $('#projectCreationForm input[name=projectName]');
    txtGp = $('#projectCreationForm input[name=gp]');
    txtFinalDate = $('#projectCreationForm input[name=finalDate]');
    btnProjectCreate = $('#projectCreationForm button[id=btnCreate]');
    
    clearFields();
    
    projectCreationStatus = $('#projectCreationStatus');
    projectUpdateStatus = $('#projectUpdateStatus');
    btnProjectCreate.off("click");
    btnProjectCreate.click(function(event){
        $.ajax({
            type: "POST",
            url: "projects/create",
            data: {
                projectName: txtProjectName.val(),
                gp: txtGp.val(),
                finalDate: txtFinalDate.val()
            },
            success: function (data){
                if(data.status){
                    projectCreationStatus.empty();
                    var sucessDiv = $("<div>", {class: "alert alert-success alert-dismissible", role: "alert"});
                    sucessDiv.append($("<p>", {text: "Projeto inserido com sucesso"}));
                    projectCreationStatus.append(sucessDiv);
                    $.ajax({
                        type: "GET",
                        url: "projects/getProjectsAsJSON",
                        success: function (data){
                            drawProjectsList(projectList, data);
                            window.clearFields();
                        },
                        dataType: "json"
                    });
                    window.setTimeout(function(){
                        sucessDiv.toggle("slow", function() {
                            projectCreationStatus.empty();
                        });
                    }, 3000);
                }
                else{
                    projectCreationStatus.empty();
                    var errorDiv = $("<div>", {class: "alert alert-danger alert-dismissible", role: "alert"});
                    errorDiv.append('<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
                    var errorList = $("<ul>");
                    for(var i = 0 ; i < data.errors.length; i++){
                        errorList.append(data.errors[i]);
                    }
                    errorDiv.append(errorList);
                    projectCreationStatus.append(errorDiv);
                }
            },
            dataType: "json"
        });
    });
    
    txtProjectName = $('#projectCreationForm input[name=projectName]');
    txtGp = $('#projectCreationForm input[name=gp]');
    txtFinalDate = $('#projectCreationForm input[name=finalDate]');
    btnProjectCreate = $('#projectCreationForm button[id=btnCreate]');
    
    txtModalName = $('#projectEditForm input[name=projectName]');
    txtModalGp = $('#projectEditForm input[name=gp]');
    txtModalFinalDate = $('#projectEditForm input[name=finalDate]');
    btnProjectEdit = $('#btnProjectEdit');
    myModal = $('#myModal');  

    //===================
    //CALENDARIO
     $.datepicker.regional['br'] = {
        closeText: 'Fechar',
        prevText: '<Anterior',
        nextText: 'Seguinte',
        currentText: 'Hoje',
        monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho',
        'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
        monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun',
        'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
        dayNames: ['Domingo', 'Segunda-feira', 'Ter&ccedil;a-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'S&aacute;bado'],
        dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'S&aacute;b'],
        dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'S&aacute;b'],
        weekHeader: 'Sem',
        dateFormat: 'dd/mm/yy',
        firstDay: 0,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };
    $.datepicker.setDefaults($.datepicker.regional['br']);
    $( "#finalDateInput" ).datepicker( $.datepicker.regional[ "br" ] );  
});
