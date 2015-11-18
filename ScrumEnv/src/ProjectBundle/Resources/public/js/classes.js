var myObject_nosorted = {};
var NodeArray = [];
var NodeArray_temp = [];
var NodeArray_sorted = [];
var position = 1;
var compteur = 0;

function nosorted (node_dependent, node_depend, cost){
   var myObject = {
         node_object : node_dependent,
         node_dependence : node_depend,
         node_next: ["none"],
         cost_task: cost,
         cost_as_soon : 0,
         cost_as_late: 0,
         compteur:0,
         pert_position : position

    }

   NodeArray.push(myObject);
}


  var depart = {
         node_object : "depart",
         node_dependence : "none",
         node_next : ["none"],
         pert_position : 0,
         cost_as_late: 0,
         cost_task: 0,
         compteur:0,
         cost_as_soon : 0

    }

NodeArray_sorted.push(depart);
compteur ++;


//first sorted for the pertt generation.
// With this we initialize the first loop of our pertt diagram and prepare temp variable for the rest of the diagram
function sorted(){

        for (var i = 0; i < NodeArray.length ; i++){
            if (NodeArray[i].node_dependence == "depart"){
                NodeArray[i].cost_as_soon += NodeArray[i].cost_task;
                NodeArray[i].compteur = compteur;
                NodeArray_sorted.push(NodeArray[i]);
                
            }
            else {
                NodeArray_temp.push(NodeArray[i]);
            }
        }
        compteur ++;

        while(NodeArray_sorted.length != NodeArray.length +1){
             sorted_end(NodeArray_temp);     
        }
     
}

//first sorted for the pertt generation.
// With this we initialize the first loop of our pertt diagram and prepare temp variable for the rest of the diagram
function sorted_with_multiple_dependencies(){

       

        for (var i = 0; i < NodeArray.length ; i++){
          
            var check_first_dependence = false;
            var temp= extract_dependences(NodeArray[i].node_dependence);
            NodeArray[i].node_dependence = temp;
            
            for (var j = 0 ; j < NodeArray[i].node_dependence.length; j++){
              
                if (NodeArray[i].node_dependence[j] == "depart" &&  NodeArray[i].node_dependence.length == 1 ){
                         check_first_dependence = true;
                }
                 
            }

             if (check_first_dependence){
                 NodeArray[i].compteur = compteur;
                 NodeArray_sorted.push(NodeArray[i]);
                 compteur ++;           
             }
             else {
                NodeArray_temp.push(NodeArray[i]);
            }
        }

        
        while(NodeArray_temp.length > 0){
            
             sorted_end_with_multiple_dependencies(NodeArray_temp);     
        }
}

function extract_dependences(chaine){
var tableau=chaine.split(";");
    return tableau;
}

// The end of the function. She allow us to finish the filling of the rest of output array
function sorted_end_with_multiple_dependencies(tab){
        
        position ++;
        for (var i = 0; i < tab.length ; i++){
             alert(tab.length);
             check = false;
                for (var k=0 ; k < tab[i].node_dependence.length; k ++){
                    for (var j =0 ; j < NodeArray_sorted.length; j ++){
                        
                            if (NodeArray_sorted[j].node_object ==  tab[i].node_dependence[k] && tab[i].node_dependence.length  ==  1){    
                                tab[i].pert_position = position;
                                tab[i].compteur = compteur;
                                NodeArray_sorted.push(tab[i]);
                                check = true; 
                                compteur ++;
                            }

                            else if (NodeArray_sorted[j].node_object == tab[i].node_dependence[k] && tab[i].node_dependence.length > 1 ){    
                                tab[i].pert_position = NodeArray_sorted[j] + 1;
                                tab[i].compteur = compteur;
                                check = true; 
                                NodeArray_sorted.push(tab[i]);
                                compteur ++;
                            }
                 }  
            }  
            if (check == true){tab.splice(i, 1);}
                 alert(tab.length); 
        }
}

 /* else if (NodeArray_sorted[j].node_object == tab[i].node_dependence[k] && tab[i].node_dependence.length > 1 ){    
                        tab[i].pert_position = NodeArray_sorted[j] + 1;
                        tab[i].compteur = compteur;
                        NodeArray_sorted.push(tab[i]);
                        compteur ++;
                    }*/



// The end of the function. She allow us to finish the filling of the rest of output array
function sorted_end(tab){
        for (var i = 0; i < tab.length ; i++){
            position ++;
            for (var j =0 ; j < NodeArray_sorted.length; j ++){
               
                if ( NodeArray_sorted[j].node_object == tab[i].node_dependence){    
                    tab[i].pert_position = position;
                    cost_as_soon_as_possible_with_multiple_dependencies(tab[i]);
                    tab[i].compteur = compteur;
                    NodeArray_sorted.push(tab[i]);
                    compteur ++;
                }
            }
        }
}


function find_next_node(){
    var next = 0;
    for (var i = NodeArray_sorted.length - 1 ; i >= 0 ; i -- ){
           
            for (var j = NodeArray_sorted.length - 2 ; j >= 0 ; j --){
               
                for (var k = 0; k < NodeArray_sorted[i].node_dependence.length; k++){
                     if ( NodeArray_sorted[i].node_dependence[k] == NodeArray_sorted[j].node_object){    
                     NodeArray_sorted[j].node_next[next] = NodeArray_sorted[i].node_object;
                     next ++;
                     }
                } 
            }
    }
}

//function which calcul as soon as possible the project can finish
function cost_as_soon_as_possible(current_object){

        for ( var i = 0; i < NodeArray_sorted.length; i++ ){
                 if ( current_object.node_dependence == NodeArray_sorted[i].node_object ){
                    current_object.cost_as_soon = (current_object.cost_task + NodeArray_sorted[i].cost_as_soon);

                 }      
        }
}
//function which calcul as soon as possible the project can finish
function cost_as_soon_as_possible_with_multiple_dependencies(){

       for (var k = 1; k< NodeArray_sorted.length; k++){
            if ( NodeArray_sorted[k].pert_position > 0){
               for ( var j = 0; j < NodeArray_sorted[k].node_dependence.length; j++){
                   for ( var i = 0; i < NodeArray_sorted.length; i++ ){
                        
                     if ( NodeArray_sorted[k].node_dependence[j] == NodeArray_sorted[i].node_object  &&  NodeArray_sorted[k].cost_as_soon < NodeArray_sorted[k].cost_task + NodeArray_sorted[i].cost_as_soon){

                        NodeArray_sorted[k].cost_as_soon = (NodeArray_sorted[k].cost_task + NodeArray_sorted[i].cost_as_soon);
                     }     
                 }        
               }
            }
          
       }
           
}

function cost_as_late_as_possible_with_multiple_dependencies( sprint_time){

     for( var i = 0; i < NodeArray_sorted.length; i++ ){
          
            if (NodeArray_sorted[i].node_next == "none"){
                NodeArray_sorted[i].cost_as_late = sprint_time;      
            }
      }

       while ( position != 0){
          position -- ;
            for( var i = 0; i < NodeArray_sorted.length; i++ ){
                 if (NodeArray_sorted[i].cost_as_late == 0 && NodeArray_sorted[i].node_object != "depart" && NodeArray_sorted[i].pert_position == position){
                     for (var j = i + 1; j < NodeArray_sorted.length; j ++){
                        for (var k= 0; k < NodeArray_sorted[i].node_next.length; k++ ){
                             if ( NodeArray_sorted[j].node_object == NodeArray_sorted[i].node_next[k] && NodeArray_sorted[j].cost_as_late != 0 &&  NodeArray_sorted[i].cost_as_late < NodeArray_sorted[j].cost_as_late - NodeArray_sorted[j].cost_task ){
                               NodeArray_sorted[i].cost_as_late = NodeArray_sorted[j].cost_as_late - NodeArray_sorted[j].cost_task ;
                            }
                        }             
                    }        
                }      
             } 
        }     
}

function cost_as_late_as_possible( sprint_time){

     for( var i = 0; i < NodeArray_sorted.length; i++ ){
          
            if (NodeArray_sorted[i].node_next == "none"){
                NodeArray_sorted[i].cost_as_late = sprint_time;      
            }
      }

       while ( position != 0){
          position -- ;
            for( var i = 0; i < NodeArray_sorted.length; i++ ){
                 if (NodeArray_sorted[i].cost_as_late == 0 && NodeArray_sorted[i].node_object != "depart"){
                     for (var j = 0; j < NodeArray_sorted.length; j ++){
                         if ( NodeArray_sorted[j].node_object == NodeArray_sorted[i].node_next && NodeArray_sorted[j].cost_as_late != 0 ){
                               NodeArray_sorted[i].cost_as_late = NodeArray_sorted[j].cost_as_late - NodeArray_sorted[j].cost_task ;
                            
                        }
                                    
                    }
                           
                }      
             } 
        }     
}


// display of the pertt diagram
function display(){

     var g = new Graph();
     var width = 400;
     var height =400;
     sorted_with_multiple_dependencies();
     cost_as_soon_as_possible_with_multiple_dependencies();
     find_next_node();
     cost_as_late_as_possible_with_multiple_dependencies(7);
    
    for ( var i = 0  ; i < NodeArray_sorted.length ; i ++){

         for ( var j = 1  ; j < NodeArray_sorted.length ; j ++){

             for (var k = 0; k < NodeArray_sorted[j].node_dependence.length; k++ ){

                if (NodeArray_sorted[i].node_object == NodeArray_sorted[j].node_dependence[k]){
                     g.addNode(i,{ label  : NodeArray_sorted[i].compteur + "\n" + NodeArray_sorted[i].cost_as_soon + "  | " + NodeArray_sorted[i].cost_as_late});
                     g.addNode(j, { label  :NodeArray_sorted[j].compteur + "\n" + NodeArray_sorted[j].cost_as_soon + "  | " + NodeArray_sorted[j].cost_as_late});
                     
                     g.addEdge(i, j, { stroke : "#bfa" , fill : "#56f", label :NodeArray_sorted[j].node_object,directed : true});
                 }
            }

         } 
    }

     /* layout the graph using the Spring layout implementation */
     var layouter = new Graph.Layout.Spring(g);
     var renderer = new Graph.Renderer.Raphael('canvas', g, width, height);
}