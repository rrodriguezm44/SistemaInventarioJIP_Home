@extends('adminlte::page')

@section('content_header')

    <nav aria-label="breadcrumb" style="font-size: 18pt;">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Inicio</a></li>
            <li class="breadcrumb-item"><a href="{{ url('/admin/productos') }}">Productos</a></li>
            <li class="breadcrumb-item active" aria-current="page">Creacion de Producto</li>
        </ol>
    </nav>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title"><b>Llene los datos del Formulario</b></h3>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body" style="display: block;">
                    <form action="{{ url('/admin/productos/create') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-9">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Categoria <b>(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-tags"></i></span>
                                                </div>
                                                <select name="categoria_id" id="categoria_id" class="form-control" required>
                                                    <option value="">-- Seleccione una Categoria --</option>
                                                    @foreach ($categorias as $categoria)
                                                        <option value="{{ $categoria->id }}"
                                                            {{ old('categoria_id') == $categoria->id ? 'selected' : '' }}>
                                                            {{ $categoria->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('nombre')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="codigo">Codigo <b>(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-barcode"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('codigo') }}" class="form-control"
                                                    id="codigo" name="codigo"
                                                    placeholder="Ingrese la codigo del producto" required>
                                            </div>
                                            @error('codigo')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="nombre">Nombre <b>(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-box"></i></span>
                                                </div>
                                                <input type="text" value="{{ old('nombre') }}" class="form-control"
                                                    id="nombre" name="nombre"
                                                    placeholder="Ingrese el nombre del producto" required>
                                            </div>
                                            @error('nombre')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="descripcion">Descripcion <b>(*)</b></label>
                                            <div class="editor-wrapper">
                                                <textarea id="descripcion" name="descripcion"></textarea>
                                            </div>
                                            @error('descripcion')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="precio_compra">Precio Compra <b style="color: red">(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                                                </div>
                                                <input style="text-align: center" type="text" value="{{ old('precio_compra') }}" class="form-control"
                                                    id="precio_compra" name="precio_compra"
                                                    required>
                                            </div>
                                            @error('precio_compra')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="precio_venta">Precio Venta <b style="color: red">(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-money-bill-wave"></i></span>
                                                </div>
                                                <input style="text-align: center" type="text" value="{{ old('precio_venta') }}" class="form-control"
                                                    id="precio_venta" name="precio_venta"
                                                    required>
                                            </div>
                                            @error('precio_venta')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock_minimo">Stock Minimo <b style="color: red">(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-arrow-down"></i></span>
                                                </div>
                                                <input style="text-align: center" type="text" value="{{ old('stock_minimo') }}" class="form-control"
                                                    id="stock_minimo" name="stock_minimo"
                                                    required>
                                            </div>
                                            @error('stock_minimo')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="stock_maximo">Stock Maximo <b style="color: red">(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-arrow-up"></i></span>
                                                </div>
                                                <input style="text-align: center" type="text" value="{{ old('stock_maximo') }}" class="form-control"
                                                    id="stock_maximo" name="stock_maximo"
                                                    required>
                                            </div>
                                            @error('stock_maximo')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="unidad_medida">Unidad de Medida<b style="color: red">(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-arrow-up"></i></span>
                                                </div>
                                                <select name="unidad_medida" id="unidad_medida" class="form-control">
                                                    <option value="">Seleccione U. Medida</option>
                                                    <option value="uni">Unidad</option>
                                                    <option value="kg">Kg</option>
                                                    <option value="lt">Litro</option>
                                                    <option value="pqt">Paquete</option>
                                                    <option value="eqi">Equipo</option>
                                                </select>
                                            </div>
                                            @error('unidad_medida')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="estado">Estado<b style="color: red">(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-arrow-up"></i></span>
                                                </div>
                                                <select class="form-control" name="estado" id="estado" required>
                                                    <option value="">-- Seleccione una opción --</option>
                                                    <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Disponible
                                                    </option>
                                                    <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>No Disponible
                                                    </option>   
                                                </select>
                                            </div>
                                            @error('estado')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="imagen">Imagen del Producto<b style="color: red">(*)</b></label>
                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-imagen"></i></span>
                                                </div>
                                                <input type="file" class="form-control" id="imagen" name="imagen"
                                                    accept="image/*" onchange="previewImage(event)" required>
                                                   
                                            </div>
                                             <br><br><br>
                                                    <img id="imgPreview" src="#" alt="Vista previa del aimagen" width="100%">
                                                    <script>
                                                        function previewImage(event){
                                                            const input = event.target;
                                                            const file = input.files[0];
                                                            if(file){
                                                                const reader = new FileReader();
                                                                reader.onload = function(e){
                                                                    const imgpreview = document.getElementById('imagePreview');
                                                                    imgPreview.src = e.target.result;
                                                                    imgPreview.style.display = 'block';
                                                                }
                                                                reader.readAsDataURL(file);
                                                            }
                                                        }
                                                    </script>
                                            @error('imagen')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <a href="{{ url('admin/sucursales') }}" class="btn btn-danger">Cancelar</a>
                                        <button type="submit" class="btn btn-success">Guardar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@stop

@section('css')
<style>
   .ck.ck-editor {
       width: 100% !important;
   }
   
   .ck-editor__editable {
       width: 100% !important;
       min-height: 300px;
       box-sizing: border-box;
   }
   
   .ck.ck-toolbar {
       flex-wrap: wrap;
   }
   
   @media (max-width: 768px) {
       .ck-editor__editable {
           min-height: 250px;
           padding: 10px;
       }
   }
</style>
@stop

@section('js')
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script>
   ClassicEditor
       .create(document.querySelector('#descripcion'), {
           toolbar: {
               items: [
                   'heading', '|',
                   'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', '|',
                   'link', 'bulletedList', 'numberedList', '|',
                   'outdent', 'indent', '|',
                   'alignment', '|',
                   'blockQuote', 'insertTable', 'mediaEmbed', '|',
                   'undo', 'redo', '|',
                   'fontBackgroundColor', 'fontColor', 'fontSize', 'fontFamily', '|',
                   'code', 'codeBlock', 'htmlEmbed', '|',
                   'sourceEditing'
               ],
               shouldNotGroupWhenFull: true
           },
           language: 'es'
       })
       .then(editor => {
           // Forzar responsive después de crear el editor
           const editorEl = editor.ui.view.element;
           editorEl.style.width = '100%';
           editorEl.querySelector('.ck-editor__editable').style.width = '100%';
       })
       .catch(error => {
           console.error(error);
       });
</script>
@stop
