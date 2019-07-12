<div class="m-2">
    <div class="row pt-3">
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Merk Mobil</th>
                    <th>Type Mobil</th>
                    <th>Tahun</th>
                    <th>No. Pol</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @php $i=1 @endphp
                @foreach($dataMobil as $dm)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$dm->merkMobil}}</td>
                    <td>{{$dm->typeMobil}}</td>
                    <td>{{$dm->tahun}}</td>
                    <td>{{$dm->noPol}}</td>
                    <td>
                        <button class="btn btn-info btn-sm pull-right" onclick="pilihMobil('{{$dm->idMobil}}','{{$dm->merkMobil}}')" data-toggle="modal" data-target="#modalMobil"> <i class="fa fa-check"> pilih</i> </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>


</div>


<script>
    function pilihMobil(id, merk) {
        $('#reqMobil').val(id);
        $('#merkMobil').val(merk);
    }
</script>

