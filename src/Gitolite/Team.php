<?php

namespace Gitolite;

/**
 * Gitolite Team Class
 *
 * Project:   gitolite-php
 * File:      src/Gitolite/Team.php
 *
 * Copyright (C) 2012 Rafael Goulart
 *
 * This program is free software; you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published by  the Free
 * Software Foundation; either version 2 of the License, or (at your option)
 * any later version.
 *
 * @author  Rafael Goulart <rafaelgou@gmail.com>
 * @license GNU Lesser General Public License
 * @link    https://github.com/rafaelgou/gitolite-php
 * see CHANGELOG
 */
class Team
{
    protected $name = null;
    protected $users = array();
    protected $teams = array();

    /**
     * Set Name
     *
     * @param string $name The team name
     *
     * @return Team
     */
    public function setName($name)
    {
        $this->name = (string) $name;
        return $this;
    }

    /**
     * Get Name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get Formated Name (as @team)
     *
     * @return string
     */
    public function getFormatedName()
    {
        return '@' . $this->name;
    }

    /**
     * Set Users (An array of user objects)
     *
     * @param User[]|array $users
     *
     * @return $this
     */
    public function setUsers(array $users)
    {
        $this->users = array();
        foreach ($users as $user) {
            $this->addUser($user);
        }
        return $this;
    }

    /**
     * Get Users
     *
     * @return User[]|array
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Add user (An user object)
     *
     * @param User $user
     *
     * @return $this
     */
    public function addUser(User $user)
    {
        $this->users[] = $user;
        return $this;
    }

    /**
     * Set Teams (An array of team objects)
     *
     * @param Team[]|array $teams
     *
     * @return $this
     */
    public function setTeams(array $teams)
    {
        $this->teams = array();
        foreach ($teams as $team) {
            $this->addTeam($team);
        }
        return $this;
    }

    /**
     * Get Teams
     *
     * @return Team[]|array
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * Add Team
     *
     * @param Team $team A team object
     *
     * @return $this
     */
    public function addTeam(Team $team)
    {
        $this->teams[] = $team;
        return $this;
    }

    /**
     * Returns team group line
     *
     * Format: @<team_name> = <user 1> <user 2> <user 3> <user 'n'>
     *
     * @param boolean $nl Include a new line (default true)
     *
     * @return string
     */
    public function render($nl=true)
    {
        $users = array();
        foreach ($this->getUsers() as $user) {
            $users[] = $user->getUsername();
        }

        $teams = array();
        foreach ($this->getTeams() as $team) {
            $teams[] = $team->getFormatedName();
        }

        return $this->getFormatedName() . ' = '
                . implode(' ', $users) . ' '
                . implode(' ', $teams)
                . ($nl ? PHP_EOL : '');
    }

}