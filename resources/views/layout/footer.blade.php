--
<!-- Footer -->
{{-- footer --}}

<div style=" position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    background: linear-gradient(to left, #4facfe 0%, #00f2fe 100%) !important;
    color: black;
    text-align: center;">
  <p style="margin-top: 15px;">
    <a href="{{ url('/') }}" style="color:black; font:bold; text-decoration:none">Home| </a><a href="contact" style="color:black; font:bold; text-decoration:none">Contact-us | </a>
    Copyright &copy; 2022 All Rights Reserved By
    <a href="{{ url('/') }}" style="text-decoration: none"><b>mForum</b></a>
  </p>
</div>

<style>
  footer {
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;

    color: black;
    text-align: center;
  }
</style>
@if (Session::has('status'))
<script>
  swal("Successfully Question Added!", "Well done", "success")
</script>
@endif
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

<script type="text/javascript">
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
</script>

<script type="text/javascript">
  $(document).ready(function() {
    let template = null;
    $('.modal').on('show.bs.modal', function(event) {
      template = $(this).html();
    });

    $('.modal').on('hidden.bs.modal', function(e) {
      $(this).html(template);
    });
  });
</script>

<script>
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
</script>

</body>

</html>