<?php

namespace Fhaculty\Graph\Algorithm\MinimumCostFlow;

use Fhaculty\Graph\Exception\UnexpectedValueException;
use Fhaculty\Graph\Algorithm\Base as AlgorithmBase;
use Fhaculty\Graph\Graph;

abstract class Base extends AlgorithmBase {

    /**
     * Origianl graph
     * 
     * @var Graph
     */
    protected $graph;
    
    /**
     * The given graph where the algorithm should operate on
     * 
     * @param Graph $graph
     * @throws Exception if the given graph is not balanced
     */
    public function __construct(Graph $graph){
        $this->graph = $graph;
    }
    
    /**
     * check if balance is okay and throw exception otherwise
     * 
     * @throws UnexpectedValueException
     * @return AlgorithmMCF $this (chainable)
     */
    protected function checkBalance(){
        $balance = $this->graph->getBalance();
        $tolerance = 0.000001;
        if($balance >= $tolerance || $balance <= -$tolerance){
            throw new UnexpectedValueException("The given graph is not balanced value is: ".$balance);
        }
        return $this;
    }
    
    /**
     * calculate total weight along minimum-cost flow
     * 
     * @return float
     * @uses AlgorithmMCF::createGraph()
     * @uses Graph::getWeightFlow()
     */
    public function getWeightFlow(){
        return $this->createGraph()->getWeightFlow();
    }
    
    /**
     * create new resulting graph with minimum-cost flow on edges
     *
     * @throws Exception if the graph has not enough capacity for the minimum-cost flow
     * @return Graph
     */
    abstract public function createGraph();
}