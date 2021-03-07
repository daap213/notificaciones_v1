<!-- Modal -->
<div class="modal fade" id="agregar_mensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Enviar nuevo mensaje</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<form method="post" action={{route('store_mensaje')}}>
				@csrf
				  <label for="receptor">Receptor:</label><br>
				  <input class="form-control" type="text" id="receptor" name="receptor" value=""><br>
				  <label for="tema">Tema:</label><br>
				  <input class="form-control" type="text" id="tema" name="tema" placeholder="tema"><br>
				  <div class="form-group">
					<label for="mensaje">Descripcion:</label><br>
					<textarea class="form-control" rows="5" id="mensaje" name="mensaje" value="mensaje" placeholder="mensaje"></textarea><br>
					<!--<input class="form-control" type="text" id="mensaje" name="mensaje" value="mensaje">-->
				  </div><br>
				  <br><button type="submit" value="Enviar" class="btn btn-info">Guardar</button>
				</form>
      </div>
     
    </div>
  </div>
</div>