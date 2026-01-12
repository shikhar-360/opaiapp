<?php
namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

use App\Models\AdminAuditLogsModel;

class AdminAuditObserver
{
    public function created(Model $model)
    {
        $this->log('created', $model);
    }

    public function updated(Model $model)
    {
        $this->log('updated', $model);
    }

    public function deleted(Model $model)
    {
        $this->log('deleted', $model);
    }

    protected function log(string $action, Model $model)
    {
        if (!Auth::guard('admin')->check()) 
        {
            return;
        }

        if ($action !== 'updated') 
        {
            return;
        }

        $changes = $model->getChanges();

        unset($changes['updated_at']);

        if (empty($changes)) 
        {
            return;
        }

        $old = array_intersect_key(
            $model->getOriginal(),
            $changes
        );

        AdminAuditLogsModel::create([
            'admin_id'   => Auth::guard('admin')->id(),
            'app_id'     => Auth::guard('admin')->user()->app_id,
            'action'     => 'updated',
            'model'      => get_class($model),
            'model_id'   => $model->getKey(),
            'old_values' => $old,
            'new_values' => $changes,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }
}
