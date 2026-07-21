<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [

            // CORE
            'Users',
            'Roles',
            'Permissions',
            'Teams',
            'Branches',
            'Companies',

            // HRM
            'Employees',
            'Employee Profiles',
            'Designations',
            'Departments',
            'Job Openings',
            'Candidates',
            'Resume Management',
            'Interviews',
            'Offer Letters',
            'Onboarding',
            'Probation Management',
            'Attendance',
            'Leave Management',
            'Leave Types',
            'Holidays',
            'Shift Management',
            'Payroll',
            'Salary Structure',
            'Payslips',
            'Bonuses',

            // PERFORMANCE
            'Performance Reviews',
            'KPI Management',
            'Appraisals',
            'Training',
            'Certifications',

            // CRM
            'Leads',
            'Lead Sources',
            'Lead Pipeline',
            'Customers',
            'Accounts',
            'Opportunities',
            'Sales Pipeline',
            'Quotes',
            'Invoices',
            'Payments',
            'Contracts',
            'Sales Activities',

            // MARKETING
            'Campaigns',
            'Email Marketing',
            'SMS Marketing',
            'Social Media Leads',

            // SUPPORT
            'Support Tickets',
            'Knowledge Base',
            'Notifications',
            'Activity Logs',
        ];

        foreach ($modules as $module) {
            DB::table('saas_modules')->updateOrInsert(
                [
                    'module_slug' => Str::slug($module),
                ],
                [
                    'module_name' => $module,
                    'module_type' => $this->getType($module),
                    'status' => 'active',
                    'created_by' => 1,
                    'updated_at' => now(),
                    'created_at' => now(),
                ]
            );
        }
    }

    private function getType(string $module): string
    {
        $crm = [
            'Leads','Lead Sources','Lead Pipeline','Customers','Accounts',
            'Opportunities','Sales Pipeline','Quotes','Invoices','Payments',
            'Contracts','Sales Activities','Campaigns','Email Marketing',
            'SMS Marketing','Social Media Leads'
        ];

        $hrm = [
            'Employees','Employee Profiles','Designations','Departments',
            'Job Openings','Candidates','Resume Management','Interviews',
            'Offer Letters','Onboarding','Probation Management','Attendance',
            'Leave Management','Leave Types','Holidays','Shift Management',
            'Payroll','Salary Structure','Payslips','Bonuses',
            'Performance Reviews','KPI Management','Appraisals',
            'Training','Certifications'
        ];

        if (in_array($module, $crm)) return 'CRM';
        if (in_array($module, $hrm)) return 'HRM';
        return 'CORE';
    }
}
