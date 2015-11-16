$(function() {
    "use strict";

    var source = [];
    for(var i=0; i<jsonTaskList.length; i++){
        if (jsonTaskList[i].dateBeginingReal && jsonTaskList[i].dateEndReal && jsonTaskList[i].developer){
            var isNew = true;
            var j=0;
            for(; j<source.length; j++){
                if(source.name == jsonTaskList[i].developer){
                    source[j].values += {
                        from: "/Date("+jsonTaskList[i].dateBeginingReal.timestamp+")/",
                        to: "/Date("+jsonTaskList[i].dateEndReal.timestamp+")/",
                        label: jsonTaskList[i].id,
                        customClass: "ganttRed"
                          
                    };
                }
            }
            if(isNew){
                source[j] = {
                    name: jsonTaskList[i].developer,
                    desc: jsonTaskList[i].description,
                    values: [{
                        from: "/Date("+jsonTaskList[i].dateBeginingReal.timestamp+")/",
                        to: "/Date("+jsonTaskList[i].dateEndReal.timestamp+")/",
                        label: jsonTaskList[i].id,
                        customClass: "ganttRed"
                    }]
                };
            }
        }
    }
    console.log("source");
    console.log(source);
    $(".gantt").gantt({
        source: source,
        scale: "hours",
        minScale: "hours",
        navigate: "scroll"
    });
});
