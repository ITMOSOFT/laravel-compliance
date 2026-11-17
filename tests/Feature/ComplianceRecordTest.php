<?php
namespace ITMOSOFT\Compliance\Tests\Feature;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use ITMOSOFT\Compliance\Tests\TestCase;
use ITMOSOFT\Compliance\Models\ComplianceRecord;
class ComplianceRecordTest extends TestCase
{

    public function test_record_can_be_submitted_and_approved(): void
    {
        $record = ComplianceRecord::create($this->attributes());
        $this->assertTrue($record->submit());
        $this->assertTrue($record->fresh()->approve(null, 'Verified'));
        $this->assertSame('approved', $record->fresh()->status);
    }

    public function test_rejected_record_can_be_resubmitted(): void
    {
        $record = ComplianceRecord::create($this->attributes(['status' => 'rejected']));
        $this->assertTrue($record->submit());
        $this->assertSame('submitted', $record->fresh()->status);
        $this->assertNull($record->fresh()->decision_notes);
    }

    public function test_expiry_is_detected(): void
    {
        $record = ComplianceRecord::create($this->attributes(['expires_at' => now()->subDay()->toDateString()]));
        $this->assertTrue($record->isExpired());
    }


    private function attributes(array $overrides = []): array
    {
        return array_merge(['subject_type' => 'App\Models\User', 'subject_id' => 1, 'requirement_code' => 'TAX-001', 'name' => 'Tax certificate', 'status' => 'pending'], $overrides);
    }
}
