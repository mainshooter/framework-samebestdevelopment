<?php
  class HtmlGenerator {


    /**
     * generates a Table
     * @param  [array] $header [The header names]
     * @param  [assoc array] $rows   [The rows content]
     * @return [string / html]         [The table]
     */
    public function generateTable($header, $rows) {
      $table = '
        <table>
      ';

        $table .= '<tr>';
        foreach ($header as $key) {
          $table .= '<th>' . $key . '</th>';
        }
        $table .= '</tr>';

      foreach ($rows as $row) {
        $table .= '<tr>';
        foreach ($row as $key => $value) {
          $table .= '<td>' . $value . '</td>';
        }
        $table .= '</tr>';
      }

      $table .= '</table>';
      return($table);
    }

    /**
     * Prepares for the generate of the HTML selectBOS
     * @param  [string] $type [The colom we want to display]
     * @param  [INT] $selectedContactID [The selected contact]
     * @return [string HTML] $selectBox [generated selectBOX]
     */
    public function prepareGenerateSelectBox($type, $selectedContactID) {
      $ContactsService = new ContactsService();
      $contacts = $ContactsService->readContacts('');

      $columNames = ['contactID', $type, $selectedContactID];

        $class = 'class="inputAjax"';

      $selectBox = $this->createSelectBox($contacts, $columNames, $class);
      return($selectBox);
    }

    /**
     * Create selectbox with the posibility to highlight a select option when the
     * columNames[0] == $highlateID/columNames[2]
     * @param  [assoc array] $arr [the result from the db]
     * @param  [array] $columNames [All the columNames includeing the highlatedID]
     * @param  [string] $JSevent  [A string with the event we want to use in AJAX]
     * @return [string] [With the HTML selectBox]
     */
    public function createSelectBox($arr, $columNames, $class) {
      $highlateID = ISSET($columNames[2])?$columNames[2]: NULL;
      $JSevent = ISSET($JSevent)?$JSevent: NULL;

      $selectBox = "<select " . $class . ">";
      foreach ($arr as $key => $value) {
        if ($value[$columNames[0]] == $highlateID) {
          $selectBox .= '<option value="' . $value[$columNames[0]] . '" selected>' . $value[$columNames[1]] . '</option>';
        }

        else {
          $selectBox .= '<option value="' . $value[$columNames[0]] . '">' . $value[$columNames[1]] . '</option>';
        }
    }
    $selectBox .= "</select>";
    return($selectBox);
  }
}

?>
