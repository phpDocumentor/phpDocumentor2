<?php
class DocBlox_Writer_Xsl extends DocBlox_Writer_Abstract
{

  public function transform(DOMDocument $structure, DocBlox_Transformation $transformation)
  {
    if (!class_exists('XSLTProcessor'))
    {
      throw new Exception(
        'The XSL writer was unable to find your XSLTProcessor; please check if you have installed the PHP XSL extension'
      );
    }

    $artifact = $transformation->getTransformer()->getTarget() . DIRECTORY_SEPARATOR . $transformation->getArtifact();

    $xsl = new DOMDocument();
    $xsl->load($transformation->getSource());

    $proc = new XSLTProcessor();
    $proc->importStyleSheet($xsl);
    $proc->setParameter('', 'root', str_repeat('../', substr_count($transformation->getArtifact(), '/')));
    $proc->setParameter('', 'search_template', $transformation->getParameter('search', 'none'));

    // check parameters for variables and add them when found
    $this->setProcessorParameters($transformation, $proc);

    // if a query is given, then apply a transformation to the artifact location by replacing ($<var>} with the
    // sluggified node-value of the search result
    if ($transformation->getQuery() !== '')
    {
      $xpath = new DOMXPath($transformation->getTransformer()->getSource());
      $qry = $xpath->query($transformation->getQuery());
      foreach ($qry as $element)
      {
        $proc->setParameter('', $element->nodeName, $element->nodeValue);
        $filename = str_replace(
          '{$'. $element->nodeName.'}',
          $transformation->getTransformer()->generateFilename($element->nodeValue),
          $artifact
        );
        $this->log('Processing the file: ' . $element->nodeValue . ' as ' . $filename);
        $proc->transformToURI($structure, 'file://' . $filename);
      }
    }
    else
    {
      if (substr($transformation->getArtifact(), 0, 1) == '$')
      {
        // not a file, it must become a variable!
        if (!isset($this->getConfig()->transformations->{'xsl.variables'}))
        {
          $this->getConfig()->transformations->{'xsl-variables'} = new Zend_Config(array(), true);
        }

        $variable_name = substr($transformation->getArtifact(), 1);
        $this->getConfig()->transformations->{'xsl-variables'}->$variable_name = $proc->transformToXml($structure);
      } else
      {
        $proc->transformToURI($structure, 'file://' . $artifact);
      }
    }
  }

  /**
   * Sets the parameters of the XSLT processor.
   *
   * @param DocBlox_Transformation $transformation
   * @param XSLTProcessor $proc
   *
   * @return void
   */
  public function setProcessorParameters(DocBlox_Transformation $transformation, XSLTProcessor &$proc)
  {
    // first add the parameters are they are stored in the global configuration
    if (isset($this->getConfig()->transformations->{'xsl-variables'}))
    {
      /** @var Zend_Config $variable */
      foreach ($this->getConfig()->transformations->{'xsl-variables'} as $key => $variable)
      {
        // XSL does not allow both single and double quotes in a string
        if ((strpos($variable, '"') !== false) && ((strpos($variable, "'") !== false)))
        {
          $this->log(
            'XSLT does not allow both double and single quotes in a variable; '
              . 'transforming single quotes to a character encoded version in variable: ' . $key,
            Zend_Log::WARN
          );
          $variable = str_replace("'", "&#39;", $variable);
        }

        $proc->setParameter('', $key, $variable);
      }
    }

    // add / overwrite the parameters with those defined in the transformation entry
    $parameters = $transformation->getParameters();
    if (isset($parameters['variables']))
    {
      /** @var DOMElement $variable */
      foreach ($parameters['variables'] as $key => $value)
      {
        $proc->setParameter('', $key, $value);
      }
    }
  }

}