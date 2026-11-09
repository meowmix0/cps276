<?php

require_once 'Pdo_methods.php';

class Date_time
{
    public function checkSubmit()
    {
        if (isset($_POST['addNote'])) {
            return $this->addNote();
        }

        if (isset($_POST['getNotes'])) {
            return $this->getNotes();
        }

        return '';
    }

    private function addNote()
    {
        $dateTime = trim($_POST['dateTime'] ?? '');
        $note = trim($_POST['note'] ?? '');

        if ($dateTime === '' || $note === '') {
            return $this->displayMessage(
                'You must enter a date, time, and note.',
                'danger'
            );
        }

        $timestamp = strtotime($dateTime);

        if ($timestamp === false) {
            return $this->displayMessage(
                'You must enter a valid date and time.',
                'danger'
            );
        }

        $pdo = new PdoMethods();

        $sql = "INSERT INTO notes (date_time, note)
                VALUES (:date_time, :note)";

        $bindings = [
            [':date_time', $timestamp, 'int'],
            [':note', $note, 'str']
        ];

        $result = $pdo->otherBinded($sql, $bindings);

        if ($result === 'error') {
            return $this->displayMessage(
                'There was an error adding the note.',
                'danger'
            );
        }

        return $this->displayMessage(
            'Note has been added.',
            'success'
        );
    }

    private function getNotes()
    {
        $begDate = trim($_POST['begDate'] ?? '');
        $endDate = trim($_POST['endDate'] ?? '');

        if ($begDate === '' || $endDate === '') {
            return $this->displayMessage(
                'No notes found for the date range selected.',
                'danger'
            );
        }

        $begTimestamp = strtotime($begDate . ' 00:00:00');
        $endTimestamp = strtotime($endDate . ' 23:59:59');

        if ($begTimestamp === false ||
            $endTimestamp === false ||
            $begTimestamp > $endTimestamp) {
            return $this->displayMessage(
                'No notes found for the date range selected.',
                'danger'
            );
        }

        $pdo = new PdoMethods();

        $sql = "SELECT date_time, note
                FROM notes
                WHERE date_time BETWEEN :begDate AND :endDate
                ORDER BY date_time DESC";

        $bindings = [
            [':begDate', $begTimestamp, 'int'],
            [':endDate', $endTimestamp, 'int']
        ];

        $records = $pdo->selectBinded($sql, $bindings);

        if ($records === 'error' || empty($records)) {
            return $this->displayMessage(
                'No notes found for the date range selected.',
                'danger'
            );
        }

        return $this->createTable($records);
    }

    private function createTable($records)
    {
        $output = '
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Date and Time</th>
                        <th>Note</th>
                    </tr>
                </thead>
                <tbody>
        ';

        foreach ($records as $record) {
            $formattedDate = date(
                'm/d/Y h:i A',
                (int) $record['date_time']
            );

            $output .= '
                <tr>
                    <td>' . $formattedDate . '</td>
                    <td>' . htmlspecialchars($record['note']) . '</td>
                </tr>
            ';
        }

        $output .= '
                </tbody>
            </table>
        ';

        return $output;
    }

    private function displayMessage($message, $type)
    {
        return '
            <div class="alert alert-' . $type . '" role="alert">
                ' . htmlspecialchars($message) . '
            </div>
        ';
    }
}
