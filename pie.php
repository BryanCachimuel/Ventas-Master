		 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
		</div>

		
	  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
	  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
	  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap5.min.js"></script> 
		<script>
			$(document).ready( function () {
			    $('#productos').DataTable({
					    "language":{
				          "decimal": "",
				          "emptyTable": "No hay información",
				          "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
				          "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
				          "infoFiltered": "(Filtrado de _MAX_ total entradas)",
				          "infoPostFix": "",
				          "thousands": ",",
				          "lengthMenu": "Mostrar _MENU_ Entradas",
				          "loadingRecords": "Cargando...",
				          "processing": "Procesando...",
				          "search": "Buscar:",
				          "zeroRecords": "Sin resultados encontrados",
				          "paginate": {
				              "first": "Primero",
				              "last": "Ultimo",
				              "next": "Siguiente",
				              "previous": "Anterior"
				          }
			         },
			    });
			});
		</script>
	</div>
</body>
</html>