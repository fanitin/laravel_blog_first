@extends('admin.layouts.main')

@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Post creating</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("main.index")}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route("admin.post.index")}}">Post</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
          <div class="col-12">
            <form action="{{route("admin.post.store")}}" method="POST" autocomplete="off" enctype="multipart/form-data">
              @csrf
              <div class="card-body">
                <div class="form-group col-4">
                  <label for="id_title">Post title</label>
                  <input type="text" class="form-control" id="id_title" name="title" placeholder="Enter the title" value={{old('title')}}>
                  @error('title')
                      <div class="text-danger">
                        {{$message}}
                      </div>
                  @enderror
                </div>
                <div class="form-group col-10">
                  <form method="post">
                    <textarea id="summernote" name="content">
                      {{old('content')}}
                    </textarea>
                  </form>
                  @error('content')
                      <div class="text-danger">
                        {{$message}}
                      </div>
                  @enderror
                </div>
                <div class="form-group col-4">
                  <label for="id_file">Choose preview</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="id_file" name="preview_image">
                      <label class="custom-file-label" for="id_file">Choose file</label>
                    </div>
                  </div>
                  @error('preview_image')
                      <div class="text-danger">
                        {{$message}}
                      </div>
                  @enderror
                </div>
                <div class="form-group col-4">
                  <label for="id_file">Choose main image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="id_file" name="main_image">
                      <label class="custom-file-label" for="id_file">Choose file</label>
                    </div>
                  </div>
                  @error('main_image')
                      <div class="text-danger">
                        {{$message}}
                      </div>
                  @enderror
                </div>
                <div class="row">
                  <div class="form-group col-6">
                    <label>Choose category</label>
                    <select class="form-control select2 select2-hidden-accessible" name="category_id" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                      @foreach ($categories as $category)
                          <option value="{{$category->id}}"
                          {{$category->id == old('category_id') ? ' selected="selected"' : ''}}
                           >{{$category->name}}</option>
                      @endforeach
                    </select>
                    @error('category_id')
                      <div class="text-danger">
                        {{$message}}
                      </div>
                    @enderror
                  </div>

                  <div class="form-group col-6">
                    <label>Choose tags</label>
                    <select class="select2 select2-hidden-accessible" multiple="multiple" name="tag_ids[]" data-placeholder="Select tags" style="width: 100%;" data-select2-id="7" tabindex="-1" aria-hidden="true">
                      @foreach ($tags as $tag)
                          <option value="{{$tag->id}}"
                          {{ is_array(old('tag_ids')) && in_array($tag->id, old('tag_ids')) ? ' selected="selected"' : ''}}  
                          >{{$tag->name}}</option>
                      @endforeach
                    </select>
                    @error('tag_ids')
                      <div class="text-danger">
                        {{$message}}
                      </div>
                    @enderror
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Create post</button>
                </div>
              </div>
            </form>
          </div>
        </div><!-- /.row -->
      </div><!--/. container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection