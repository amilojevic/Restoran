  $.ajax({
            'type': 'POST',
            'url': 'backend_api/ajax_save_appointment',
            'data': postData,
            'success': function(response)
             {
                 $("body").html(response);
             },
             'error': function(jqXHR, textStatus, errorThrown)
             {
               console.log('Error on saving appointment:', jqXHR, textStatus, errorThrown);    
             }
          });