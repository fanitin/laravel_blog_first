@extends('personal.layouts.main')

@section('content')
      <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Comment</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route("personal.index")}}">Home</a></li>
              <li class="breadcrumb-item active">Your comments</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div><!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-8">
            <div class="card">
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Comment text</th>
                      <th colspan="3" class="text-center">Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($comments as $comment)
                        <tr>
                          <td>{{$comment->id}}</td>
                          <td>{{$comment->comment}}</td>
                          <td class="text-center"><a href="{{ route("personal.comment.edit", $comment->id) }}" class="text-success"><i class="fas fa-regular fa-pen"></i></a></td>
                          <td class="text-center">
                            <form action="{{route("personal.comment.delete", $comment->id)}}" method="POST">
                              @csrf
                              @method("DELETE")
                              <button type="submit" class="border-0 bg-transparent">
                                <i class="fas fa-solid fa-trash text-danger" role="button"></i>
                              </button>
                            </form>
                          </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div><!--/. container-fluid -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection