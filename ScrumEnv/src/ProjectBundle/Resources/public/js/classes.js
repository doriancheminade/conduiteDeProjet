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
         node_next : "none",
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
         node_next : "none",
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
                compteur ++;
            }
            else {
                NodeArray_temp.push(NodeArray[i]);
            }
        }

        while(NodeArray_sorted.length != NodeArray.length +1){
             sorted_end(NodeArray_temp);     
        }
     
}

// The end of the function. She allow us to finish the filling of the rest of output array
function sorted_end(tab){

        

        for (var i = 0; i < tab.length ; i++){
            position ++;
            for (var j =0 ; j < NodeArray_sorted.length; j ++){
               
                if ( NodeArray_sorted[j].node_object == tab[i].node_dependence){    
                    tab[i].pert_position = position;
                    cost_as_soon_as_possible(tab[i]);
                   tab[i].compteur = compteur;
                    NodeArray_sorted.push(tab[i]);
                    compteur ++;
                }
            }


        }
}

function find_next_node(){

    for (var i = NodeArray_sorted.length - 1 ; i >= 0 ; i -- ){
           
            for (var j = NodeArray_sorted.length - 2 ; j >= 0 ; j --){
               
                if ( NodeArray_sorted[i].node_dependence == NodeArray_sorted[j].node_object){    
                    NodeArray_sorted[j].node_next = NodeArray_sorted[i].node_object;
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
                         if ( NodeArray_sorted[j].node_object == NodeArray_sorted[i].node_next ){
                            if ( NodeArray_sorted[j].cost_as_late != 0 ){
                               NodeArray_sorted[i].cost_as_late = NodeArray_sorted[j].cost_as_late - NodeArray_sorted[j].cost_task ;
                            }
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
     sorted();
     find_next_node();
     cost_as_late_as_possible(7);
   
    for ( var i = 0  ; i < NodeArray_sorted.length ; i ++){

         for ( var j = 1  ; j < NodeArray_sorted.length ; j ++){
             if (NodeArray_sorted[i].node_object == NodeArray_sorted[j].node_dependence){
             g.addNode(i,{ label  : NodeArray_sorted[i].compteur + "\n" + NodeArray_sorted[i].cost_as_soon + "  | " + NodeArray_sorted[i].cost_as_late});
             g.addNode(j, { label  :NodeArray_sorted[j].compteur + "\n" + NodeArray_sorted[j].cost_as_soon + "  | " + NodeArray_sorted[j].cost_as_late});
             
             g.addEdge(i, j, { stroke : "#bfa" , fill : "#56f", label :NodeArray_sorted[j].node_object,directed : true});
             
            }

         } 
    }

     /* layout the graph using the Spring layout implementation */
     var layouter = new Graph.Layout.Spring(g);
     var renderer = new Graph.Renderer.Raphael('canvas', g, width, height);
}