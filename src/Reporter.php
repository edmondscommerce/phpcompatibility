<?php

namespace EdmondsCommerce\PhpCompatibility;

use EdmondsCommerce\JiraShell\JiraShell;

class Reporter
{
    /**
     * @var JiraShell
     */
    private $jiraShell;

    /**
     * @var string
     */
    private $reportPath;


    /**
     * Reporter constructor.
     * @param JiraShell $jiraShell
     * @param $reportPath string The file path to the json output from the sniffer tool
     */
    public function __construct(JiraShell $jiraShell, $reportPath)
    {
        $this->jiraShell = $jiraShell;
        $this->reportPath = $reportPath;
    }

    /**
     * @return array
     */
    public function readReport()
    {

    }

    public function createTickets()
    {

    }
}