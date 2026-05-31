<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    /**
     * List all contact form messages.
     */
    public function index()
    {
        $messages = ContactMessage::orderBy('id', 'desc')->paginate(25);
        return view('admin.contact_messages.index', compact('messages'));
    }

    /**
     * Delete a contact form message.
     */
    public function destroy($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->delete();
        return back()->with('success', 'Message deleted successfully.');
    }

    /**
     * Export contact messages to CSV, Excel, or PDF print.
     */
    public function exportMessages(Request $request)
    {
        $messages = ContactMessage::orderBy('id', 'desc')->get();

        $format = strtolower($request->input('format') ?? 'csv');

        if ($format === 'pdf') {
            return view('admin.contact_messages.print', compact('messages'));
        }

        $filename = "contact_messages_export_" . date('Ymd_His') . ($format === 'excel' ? '.xls' : '.csv');
        
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        
        $output = fopen('php://output', 'w');
        
        // Output CSV column headers
        fputcsv($output, ['S.No', 'Date', 'Name', 'Email', 'Mobile No', 'Subject', 'Message']);
        
        foreach ($messages as $index => $msg) {
            fputcsv($output, [
                $index + 1,
                date('d M Y, h:i A', strtotime($msg->created_at)),
                $msg->name,
                $msg->email,
                $msg->phone ?? 'N/A',
                $msg->subject ?? 'N/A',
                $msg->message
            ]);
        }
        
        fclose($output);
        exit;
    }

    /**
     * Mark a contact message as viewed/read.
     */
    public function markAsRead($id)
    {
        $message = ContactMessage::findOrFail($id);
        $message->update(['status' => 'Read']);
        return response()->json(['success' => true]);
    }
}
