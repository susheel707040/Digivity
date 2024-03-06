<?php

namespace App\Models\MasterAdmin\GlobalSetting;
use App\Models\Record;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Str;


class SchoolInformation extends Record
{
    use SoftDeletes;
    protected $fillable = [
        "id",
        "school_name",
        "school_no",
        "affiliation_to",
        "school_short_name",
        "affiliation_no",
        "associates",
        "trust_society_name",
        "trust_society_no",
        "contact_number",
        "email_address",
        "support_email",
        "website",
        "address1",
        "address2",
        "establishment_year",
        "establishment_code",
        "chairman",
        "iso_details",
        "working_days",
        "school_logo",
        "otp",
        "verified_at",
    ];
}
