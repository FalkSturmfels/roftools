<?php

/**
 * Created by IntelliJ IDEA.
 * User: Achim
 * Date: 30.12.2015
 * Time: 17:14
 */
class TableComponent implements IComponent
{
    private $headline;

    private $headRow = array();

    private $contentRows = array();


    // ============================================
    //
    //   Setter
    //
    // ============================================

    /**
     * @param String $headline
     */
    public function setHeadline($headline)
    {
        $this->headline = $headline;
    }

    /**
     * @param array $headRow
     */
    public function setHeadRow(array $headRow)
    {
        $this->headRow = $headRow;
    }

    /**
     * @param array $rows
     */
    public function setContentRows($rows)
    {
        $this->contentRows = $rows;
    }


    // ============================================
    //
    //   IComponent implementation
    //
    // ============================================

    public function getValue()
    {
        $value = "";

        if ($this->headline)
        {
            $value = "<h2>" . $this->headline . "</h2>\n";
        }

        if (!empty($this->contentRows) || !empty($this->headRow))
        {
            $value .= "<table>\n";

            $value .= $this->createHeadRow();
            $value .= $this->createContentRows();

            $value .= "</table>\n";
        }

        return $value;
    }

    private function createHeadRow()
    {
        $row = "";

        if (!empty($this->headRow))
        {
            $row = "";

            $row .= "<tr>\n";
            foreach ($this->headRow as $rowItem)
            {
                $row .= "<th>" . $rowItem . "</th>\n";
            }

            $row .= "</tr>\n";
        }

        return $row;
    }

    private function createContentRows()
    {
        $rows = "";
        if (!empty($this->contentRows))
        {
            foreach ($this->contentRows as $row)
            {
                $rows .= "<tr>\n";

                foreach ($row as $rowItem)
                {
                    $rows .= "<td>" . $rowItem . "</td>\n";
                }

                $rows .= "</tr>\n";
            }
        }

        return $rows;
    }
}