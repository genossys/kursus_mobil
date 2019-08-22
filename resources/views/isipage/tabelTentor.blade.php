<div class="table-responsive-lg">
    <table class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Nama Tentor</th>
                <th>Tanggal Lahir</th>
                <th>Biodata</th>
                <th>Foto</th>
                @if($state == 'master')
                <th>Action</th>
                @endif
            </tr>
        </thead>

        <tbody>
            @php $i=1; @endphp
            @foreach($tentor as $m)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$m->namaTentor}}</td>
                <td>{{$m->tanggalLahir}}</td>
                <td>{{$m->biodata}}</td>
                <td><img src="{{asset ('/tentor/'.$m->foto)}}" alt="" style="width: 100px;height: 100px;object-fit: cover"></td>
                @if($state == 'master')
                <td style="min-width: 100px"> <button class="btn btn-warning btn-sm pull-center" data-toggle="modal" data-target="#modalEditTentor" onclick="showEditData('{{$m->idTentor}}')"> <i class="fa fa-edit" aria-hidden="true"></i></button>
                    <button class="btn btn-danger btn-sm pull-center" onclick="deleteData('{{$m->idTentor}}')"> <i class="fa fa-close" aria-hidden="true"></i></button>
                </td>
                @endif
            </tr>
            @endforeach

        </tbody>

    </table>
</div>
