<?php

class RandomForest {
    private $trees = [];
    private $numTrees;
    private $maxDepth;
    private $minSamplesSplit;

    public function __construct($numTrees = 10, $maxDepth = 10, $minSamplesSplit = 2) {
        $this->numTrees = $numTrees;
        $this->maxDepth = $maxDepth;
        $this->minSamplesSplit = $minSamplesSplit;
    }

    public function train($data, $labels) {
        for ($i = 0; $i < $this->numTrees; $i++) {
            // Bootstrap sampling
            $bootstrapData = [];
            $bootstrapLabels = [];
            $dataCount = count($data);
            for ($j = 0; $j < $dataCount; $j++) {
                $randomIndex = rand(0, $dataCount - 1);
                $bootstrapData[] = $data[$randomIndex];
                $bootstrapLabels[] = $labels[$randomIndex];
            }

            $tree = new DecisionTree($this->maxDepth, $this->minSamplesSplit);
            $tree->train($bootstrapData, $bootstrapLabels);
            $this->trees[] = $tree;
        }
    }

    public function predict($sample) {
        $predictions = [];
        foreach ($this->trees as $tree) {
            $predictions[] = $tree->predict($sample);
        }

        // Voting
        $counts = array_count_values($predictions);
        arsort($counts);
        return key($counts);
    }
}

class DecisionTree {
    private $maxDepth;
    private $minSamplesSplit;
    private $tree;

    public function __construct($maxDepth = 10, $minSamplesSplit = 2) {
        $this->maxDepth = $maxDepth;
        $this->minSamplesSplit = $minSamplesSplit;
    }

    public function train($data, $labels) {
        $this->tree = $this->buildTree($data, $labels, 0);
    }

    private function buildTree($data, $labels, $depth) {
        $numSamples = count($data);
        $numFeatures = $numSamples > 0 ? count($data[0]) : 0;
        $uniqueLabels = array_unique($labels);

        if ($depth >= $this->maxDepth || count($uniqueLabels) == 1 || $numSamples < $this->minSamplesSplit) {
            return ['leaf' => true, 'label' => $this->mostCommonLabel($labels)];
        }

        $bestSplit = $this->getBestSplit($data, $labels, $numFeatures);
        if (!isset($bestSplit['feature'])) {
            return ['leaf' => true, 'label' => $this->mostCommonLabel($labels)];
        }

        $leftData = [];
        $leftLabels = [];
        $rightData = [];
        $rightLabels = [];

        foreach ($data as $i => $sample) {
            if ($sample[$bestSplit['feature']] == $bestSplit['value']) {
                $leftData[] = $sample;
                $leftLabels[] = $labels[$i];
            } else {
                $rightData[] = $sample;
                $rightLabels[] = $labels[$i];
            }
        }

        return [
            'leaf' => false,
            'feature' => $bestSplit['feature'],
            'value' => $bestSplit['value'],
            'left' => $this->buildTree($leftData, $leftLabels, $depth + 1),
            'right' => $this->buildTree($rightData, $rightLabels, $depth + 1)
        ];
    }

    private function getBestSplit($data, $labels, $numFeatures) {
        $bestGini = 1.0;
        $bestSplit = [];

        for ($f = 0; $f < $numFeatures; $f++) {
            $values = array_unique(array_column($data, $f));
            foreach ($values as $v) {
                $gini = $this->calculateGini($data, $labels, $f, $v);
                if ($gini < $bestGini) {
                    $bestGini = $gini;
                    $bestSplit = ['feature' => $f, 'value' => $v];
                }
            }
        }

        return $bestSplit;
    }

    private function calculateGini($data, $labels, $feature, $value) {
        $leftLabels = [];
        $rightLabels = [];

        foreach ($data as $i => $sample) {
            if ($sample[$feature] == $value) {
                $leftLabels[] = $labels[$i];
            } else {
                $rightLabels[] = $labels[$i];
            }
        }

        $n = count($labels);
        $nL = count($leftLabels);
        $nR = count($rightLabels);

        if ($nL == 0 || $nR == 0) return 1.0;

        $giniL = 1.0 - array_sum(array_map(function($c) use ($nL) { return pow($c / $nL, 2); }, array_count_values($leftLabels)));
        $giniR = 1.0 - array_sum(array_map(function($c) use ($nR) { return pow($c / $nR, 2); }, array_count_values($rightLabels)));

        return ($nL / $n) * $giniL + ($nR / $n) * $giniR;
    }

    private function mostCommonLabel($labels) {
        if (empty($labels)) return null;
        $counts = array_count_values($labels);
        arsort($counts);
        return key($counts);
    }

    public function predict($sample) {
        return $this->traverseTree($sample, $this->tree);
    }

    private function traverseTree($sample, $node) {
        if ($node['leaf']) {
            return $node['label'];
        }

        if ($sample[$node['feature']] == $node['value']) {
            return $this->traverseTree($sample, $node['left']);
        } else {
            return $this->traverseTree($sample, $node['right']);
        }
    }
}
?>
