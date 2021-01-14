
   function InitializaGrid(containerid,entityName,campos)
   {

      var grid = $("#"+containerid).bootgrid({
        ajax: true,
        post: function ()
        {
            return {
                entityName: entityName,
                columnsName:campos
    
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
            }
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
