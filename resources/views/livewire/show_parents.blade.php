<button class="btn btn-success btn-sm btn-lg pull-right" wire:click="showFormAdd" type="button">{{ trans('parent_trans.add_parent') }}</button><br><br>
<div class="table-responsive">
    <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
           style="text-align: center">
        <thead>
            <tr class="table-success">
                <th>#</th>
                <th>{{ trans('parent_trans.Email') }}</th>
                <th>{{ trans('parent_trans.Name_Father') }}</th>
                <th>{{ trans('parent_trans.National_ID_Father') }}</th>
                <th>{{ trans('parent_trans.Passport_ID_Father') }}</th>
                <th>{{ trans('parent_trans.Phone_Father') }}</th>
                <th>{{ trans('parent_trans.Job_Father') }}</th>
                <th>{{ trans('parent_trans.Processes') }}</th>
            </tr>
        </thead>
        <tbody>
        <?php $i = 0; ?>
        @foreach ($parents as $my_parent)
            <tr>
                <?php $i++; ?>
                <td>{{ $i }}</td>
                <td>{{ $my_parent->email }}</td>
                <td>{{ $my_parent->fatherName }}</td>
                <td>{{ $my_parent->fatherNationalID }}</td>
                <td>{{ $my_parent->Passport_ID_Father }}</td>
                <td>{{ $my_parent->fatherPhone }}</td>
                <td>{{ $my_parent->fatherJob }}</td>
                <td>
                    <button wire:click="edit({{ $my_parent->id }})" title="{{ trans('parent_trans.Edit') }}"
                            class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></button>
                    <button type="button" class="btn btn-danger btn-sm" wire:click="delete({{ $my_parent->id }})" title="{{ trans('parent_trans.Delete') }}"><i class="fa fa-trash"></i></button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>