<?php

namespace EdmondsCommerce\PhpCompatibility;

use EdmondsCommerce\JiraShell\JiraShell;

/**
 * Class ReportAdapter
 * @package EdmondsCommerce\PhpCompatibility
 * Read the contents of a PHPCS json report and generate an issue file for Jira
 */
class ReportAdapter
{
    /**
     * @var string
     */
    private $reportPath;

    /** @var  FileCollection */
    private $fileCollection;
    /**
     * @var JiraShell
     */
    private $jiraShell;

    /**
     * Reporter constructor.
     * @param JiraShell $jiraShell
     * @param $reportPath string The file path to the json output from the sniffer tool
     */
    public function __construct(JiraShell $jiraShell, $reportPath)
    {
        $this->reportPath = $reportPath;
        $this->jiraShell = $jiraShell;
    }

    /**
     * Read the report and parse the json output in to objects
     * @return $this
     * @throws \Exception
     */
    public function readReport()
    {
        $report = file_get_contents($this->reportPath);
        if ($report === false)
        {
            throw new \Exception('Could not read the report at ' . $this->reportPath);
        }

        $report = json_decode($report, true);
        if ($report === null)
        {
            throw new \Exception('Could not parse json report at ' . $this->reportPath);
        }

        $files = [];
        foreach ($report['files'] as $path => $detail)
        {
            //Ignore clean files
            if (count($detail['messages']) > 0)
            {
                $files[$path] = new File($path, $detail['messages']);
            }
        }

        $this->fileCollection = new FileCollection($files);

        return $this;
    }

    /**
     * @return $this
     */
    public function queueIssues()
    {
        foreach ($this->fileCollection->getFileArray() as $path => $file)
        {
            $title = "PHP7 : " . basename($path);
            $description = $path . "\n\n" . $file->getErrorsAsString();
            $this->jiraShell->queueIssue($title, $description);
        }

        return $this;
    }
}