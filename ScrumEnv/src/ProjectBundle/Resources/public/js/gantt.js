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
                        from: "/Date("+jsonTaskList[i].dateBeginingReal.timestamp*1000+")/",
                        to: "/Date("+jsonTaskList[i].dateEndReal.timestamp*1000+")/",
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
                        from: "/Date("+jsonTaskList[i].dateBeginingReal.timestamp*1000+")/",
                        to: "/Date("+jsonTaskList[i].dateEndReal.timestamp*1000+")/",
                        label: jsonTaskList[i].id,
                        customClass: "ganttRed"
                    }]
                };
            }
        }
    }
    $(".gantt").gantt({
        source: source,
        scale: "hours",
        minScale: "hours",
        navigate: "scroll"
    });
});
