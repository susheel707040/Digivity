<?php

namespace App\Jobs;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SeedTennantJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

   protected  $tenant;

    public function __construct(Tenant $tenant)
    {
        $this->tenant = $tenant;
        $this->tenant->run(function(){
             User::create([
                'name' => $this->tenant->name,
                'email' => $this->tenant->email,
                'password' => $this->tenant->password,
                'school_id' => $this->tenant->school_id ?? 1,
                'branches_id' => $this->tenant->branches_id ?? 1,
                'academic_id' => $this->tenant->academic_id ?? 1,
                'financial_id' => $this->tenant->financial_id ?? 1,
                'role_id' => $this->tenant->role_id ?? 1,
                'student_id' => $this->tenant->student_id ?? 1,
                'staff_id' => $this->tenant->staff_id ?? 1,
                'parent_id' =>$this->tenant->parent_id ?? 1,
            ]);
        });
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
    }
}
