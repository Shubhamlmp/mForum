
      var route = "{{ url('autocomplete-search') }}";
      $('#search').typeahead({
          source: function(query, process) {
              return $.get(route, {
                  query: query
              }, function(data) {
                  return process(data);
              });
          },
          minLength: 3,
          autoSelect: false
      });
  
      $(document).ready(function() {
          let template = null;
          $('.modal').on('show.bs.modal', function(event) {
              template = $(this).html();
          });
  
          $('.modal').on('hidden.bs.modal', function(e) {
              $(this).html(template);
          });
      });
  
  

      function validateForm() {
          document.getElementById("error").innerHTML = "";
          document.getElementById("err").innerHTML = "";
          let x = document.forms["myForm"]["require"].value;
          let y = document.forms["myForm"]["desc"].value;
          if (x == '') {
              document.getElementById("error").innerHTML = "Field is required";
              return false;
          } else if (y == '') {
              document.getElementById("err").innerHTML = "Field is required";
              return false;
          } else {
              return true;
          }
      }
 
//  **************comments******************
