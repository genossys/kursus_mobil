<div class="table-responsive-lg">
    <table class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Username</th>
                <th>Email</th>
                <th>Hak Akses</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @php $i=1; @endphp
            @foreach($user as $m)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$m->username}}</td>
                <td>{{$m->email}}</td>
                <td>{{$m->hakAkses}}</td>
                <td style="min-width: 100px">
                    <button class="btn btn-warning btn-sm pull-center" data-toggle="modal" data-target="#modalEditUser" onclick="showEditData('{{$m->id}}')"> <i class="fa fa-edit" aria-hidden="true"></i></button>
                    <button class="btn btn-danger btn-sm pull-center" onclick="deleteData('{{$m->id}}')"> <i class="fa fa-close" aria-hidden="true"></i></button>
                </td>
            </tr>
            @endforeach

        </tbody>

    </table>
</div>
