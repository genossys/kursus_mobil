<div class="table-responsive-lg">
    <table class="table table-striped  table-bordered table-hover" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Merk Mobil</th>
                <th>Type Mobil</th>
                <th>Tahun</th>
                <th>Nomor Polisi</th>
                <th>Gambar</th>
                @if($state == 'master')
                <th>Action</th>
                @endif
            </tr>
        </thead>

        <tbody>
            @php $i=1; @endphp
            @foreach($mobil as $m)
            <tr>
                <td>{{$i++}}</td>
                <td>{{$m->merkMobil}}</td>
                <td>{{$m->typeMobil}}</td>
                <td>{{$m->tahun}}</td>
                <td>{{$m->noPol}}</td>
                <td><img src="{{asset ('/mobil/'.$m->gambar)}}" alt="" style="width: 100px;height: 100px;object-fit: cover"></td>
                @if($state == 'master')
                <td style="min-width: 100px"> <button class="btn btn-warning btn-sm pull-center" data-toggle="modal" data-target="#modalEditMobil" onclick="showEditData('{{$m->idMobil}}')"> <i class="fa fa-edit" aria-hidden="true"></i></button>
                    <button class="btn btn-danger btn-sm pull-center" onclick="deleteData('{{$m->idMobil}}')"> <i class="fa fa-close" aria-hidden="true"></i></button>
                </td>
                @endif
            </tr>
            @endforeach

        </tbody>

    </table>
</div>
