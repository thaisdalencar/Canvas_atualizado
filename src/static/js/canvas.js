
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
});
