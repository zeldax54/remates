
   function InitializaGrid(containerid,entityName,campos,parentEntity,grandparentEntity=null)
   {
         
      var grid = $("#"+containerid).bootgrid({
        ajax: true,
        post: function ()
        {
            return {
                entityName: entityName,
                columnsName:campos,
                parentEntity:parentEntity,
                grandparentEntity:grandparentEntity
    
            };
        },
        url: Routing.generate('generictable'),
        formatters: {
            "commands": function(column, row)
            {
                return "<a href= '" + Routing.generate(entityName.toLowerCase()+'_edit', {id: row.id}) + "'><button type=\"button\" class=\"btn btn-xs btn-default command-edit\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-edit\"></span></button></a> " + 
                       "<a href= '" + Routing.generate(entityName.toLowerCase()+'_delete', {id: row.id}) + "'> <button type=\"button\" class=\"btn btn-xs btn-default command-delete\" data-row-id=\"" + row.id + "\"><span class=\"fa fa-trash\"></span></button></a>";
            }, 
            "fechainicio": function(column, row)
            {
                return "" + row.fechainicio.date.substring(0, 20);
            }, 
            "fechacierre": function(column, row)
            {
                return "" + row.fechacierre.date.substring(0, 20);
            },
            "fecha": function(column, row)
            {
                return "" + row.fecha.date.substring(0, 20);
            },
            "cabana": function(column, row)
            {
                return row.cabana == null?"NO ASIGNADA":row.cabana.nombre;             
            },
            "toro": function(column, row)
            {
                return row.toro == null?"NO ASIGNADA":row.toro.nombre;             
            },
            "lote": function(column, row)
            {
                return row.lote == null?"NO ASIGNADo":row.lote.nombre;             
            },
            "cabanaentity": function(column, row)
            {            
               return row.cabanaentity == null?"Sin Cabaña":row.cabanaentity.nombre;             
            },
            "lotecabanaentity": function(column, row)
            {            
               return row.lote.cabanaentity == null?"Sin Cabaña":row.lote.cabanaentity.nombre;             
            },
            "status": function(column, row)
            {
                switch (row.status){
                    case "A":
                        return "Aceptada";                     
                    case "S":
                       return "Superada";                      
                    case "R":
                       return "Rechazada";
                }             
            },
        }
       }).on("loaded.rs.jquery.bootgrid", function()
      {
        /* Executes after data is loaded and rendered */
        grid.find(".command-edit").on("click", function(e)
        {
           
        }).end().find(".command-delete").on("click", function(e)
        {
            
        });
       });
        
   }
