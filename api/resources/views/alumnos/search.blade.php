@extends('layout')

@section('title', 'alumnos')


@section('content')

<h3 align="center">Full Text Search in Laravel 6 using Ajax</h3>
     <br />
     <div class="row">
      <div class="col-md-10">
       <input type="text" name="full_text_search" id="full_text_search" class="form-control" placeholder="Search" value="">
      </div>
      <div class="col-md-2">
       @csrf
       <button type="button" name="search" id="search" class="btn btn-success">Search</button>
      </div>
     </div>
     <br />
     <div class="table-responsive">
    <table class="table table-bordered table-striped">
        <thead>
         <tr>
            <th>Customer Name</th>
            <th>Gender</th>
            <th>Address</th>
                  <th>City</th>
                  <th>Postal Code</th>
                  <th>Country</th>
         </tr>
     </thead>
     <tbody></tbody>
    </table>
   </div>   


@endsection
@section('scripts')
<script>
$(document).ready(function(){

 load_data('');

 function load_data(full_text_search_query = '')
 {
  var _token = $("input[name=_token]").val();
  $.ajax({
   url:"{{ route('alumnos.action') }}",
   method:"POST",
   data:{full_text_search_query:full_text_search_query, _token:_token},
   dataType:"json",
   success:function(data)
   {
    var output = '';
    if(data.length > 0)
    {
     for(var count = 0; count < data.length; count++)
     {
      output += '<tr>';
      output += '<td>'+data[count].id_alumno+'</td>';
    /*  output += '<td>'+data[count].Gender+'</td>';
      output += '<td>'+data[count].Address+'</td>';
      output += '<td>'+data[count].City+'</td>';
      output += '<td>'+data[count].PostalCode+'</td>';
      output += '<td>'+data[count].Country+'</td>';*/
      output += '</tr>';
     }
    }
    else
    {
     output += '<tr>';
     output += '<td colspan="6">No Data Found</td>';
     output += '</tr>';
    }
    $('tbody').html(output);
   }
  });
 }

 $('#search').click(function(){
  var full_text_search_query = $('#full_text_search').val();
  load_data(full_text_search_query);
 });

});

</script>
@endsection