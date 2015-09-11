function save(){
	var id_canvas = $("#id_canvas");
	var justificativas = $("#txtJustificativas");
	var produto = $("#txtProduto");
	var stake = $("#txtStakeholders");
	var premissas = $("#txtPremissas");
	var riscos = $("#txtRiscos");
	var objetivo = $("#textObjetivo");
	var beneficios = $("#textareaBeneficios");
	var requisitos = $("#txtRequisitos");
	var equipe = $("#txtEquipe");
	var entregas = $("#txtEntregas");
	var tempo = $("#txtTempo");
	var restricoes = $("#txtRestricoes");
	var custos = $("#txtCustos");
	var id_projeto = $("#id_projeto");

	 $.ajax({
        type: "POST",
        url: window.location.origin+"/canvas/src/index.php/projects/updateCanvas",
        data: {
            id_canvas: id_canvas.val(),
            justificativas: justificativas.val(),
            produto: produto.val(),
            stake: stake.val(),
            premissas: premissas.val(),
            riscos: riscos.val(),
            objetivo: objetivo.val(),
            beneficios: beneficios.val(),
            requisitos: requisitos.val(),
            equipe: equipe.val(),
            entregas: entregas.val(),
            tempo: tempo.val(),
            restricoes: restricoes.val(),
            custos: custos.val(),
            id_projeto: id_projeto.val()
           },
            success: function (data){
                    //mensagem informando que salvo corretamente
                    var msg = $("<div>", {class: "alert alert-success alert-dismissible", role: "alert"});
                    msg.append($("<p>", {text: "Projeto Salvo com sucesso"}));
                    $( '#alertSave' ).append(msg);
                    msg.show();                     
                    window.setTimeout(function(){                            
                        $( '#alertSave' ).empty();                            
                    }, 3000);
            },
        dataType: "text"
     });

}


$(document).ready(function(){
    projectList = $("#btnSave");
    projectList.click(function(){
    	save();
    });  
    $("#btnBack").click(function(){
        $("#Modal_back").modal('show');
        $("#btnBackOk").click(function(){
            window.open("/canvas/src/index.php/projects","_self");
        });
    }); 
});